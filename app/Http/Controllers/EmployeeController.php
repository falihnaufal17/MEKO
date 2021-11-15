<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User as Employee;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Uploader;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'loginView']]);
    }

    public function index(){
        $data = Employee::select('employee.*', 'role.name as role')
        ->leftJoin('role', 'employee.role_id', '=', 'role.id');

        return DataTables::of($data)->make(true);
    }

    public function store(Request $request){
        $payload = $request->all();
        $imageUrl = null;
        $rules = [
            'name' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'role_id' => 'required|numeric',
            'birth_date' => 'required|date',
            'birth_place' => 'required',
            'phone' => 'required|numeric|unique:App\Models\User,phone',
            'email' => 'required|unique:App\Models\User,email',
            'password' => 'required|min:8',
            'image' => 'image'
        ];

        if($request->password){
            $passwordHash = bcrypt($payload["password"]);
        }

        $validator = Validator::make($payload, $rules, [
            'required' => "The field :attribute is required",
            'unique' => ":attribute is already exist",
            'image' => "The field :attribute must be image (jpg, jpeg, png, bmp, gif, svg, or webp)"
        ]);

        if($validator->fails()){
            return response()->json([
                "success" => false,
                "message" => "Form invalid",
                "data" => $validator->errors()
            ], 400);
        }

        if($request->hasFile('image')){
            $imageUrl = Uploader::uploadToS3('employee', $request->image, $request->image->getClientOriginalName());
        }

        $employee = Employee::create(array_merge($payload, ['password' => $passwordHash, 'image' => $imageUrl]));

        return response()->json([
            "success" => true,
            "message" => "Success add new employee",
            "data" => $employee
        ]);
    }

    public function login(Request $request){
        $payload = $request->all();
        $credentials = request(['phone', 'password']);
        $rules = [
            'phone' => 'required|numeric',
            'password' => 'required'
        ];

        $validator = Validator::make($payload, $rules, [
            'required' => "The field :attribute is required",
            'numeric' => ":attribute must be number"
        ]);

        if($validator->fails()){
            return response()->json([
                "success" => false,
                "message" => "Form invalid",
                "data" => $validator->errors()
            ], 400);
        }

        if(!$token = auth()->attempt($credentials)){
            return response()->json([
                "success" => false,
                "message" => "Phone or Password doesn't match",
                "data" => null
            ], 401);
        }

        return $this->respondWithToken($token);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'data' => auth()->user()
        ]);
    }

    public function detail($id){
        $employee = Employee::find($id);

        if(!$employee){
            return response()->json([
                'success' => false,
                'message' => "Employee with id $id is not found",
                'data' => $employee
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Success fetch employee with id :id',
            'data' => $employee
        ]);
    }

    public function update(Request $request, $id){
        $payload = $request->all();
        $phone = $request->phone;
        $email = $request->email;
        $imageUrl = null;

        $rules = [
            'name' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'role_id' => 'required|numeric',
            'birth_date' => 'required|date',
            'birth_place' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required',
            'image' => 'image'
        ];

        $validator = Validator::make($payload, $rules, [
            'required' => "The field :attribute is required",
            'image' => "The field :attribute must be jpg, jpeg, png, bmp, gif, svg, or webp image"
        ]);

        if($request->hasFile('image')){
            $imageUrl = Uploader::uploadToS3('employee', $request->image, $request->image->getClientOriginalName());
        }

        $exitsUser = Employee::find($id);

        if($phone == $exitsUser->phone && $id != $exitsUser->id){
            return response()->json([
                "success" => false,
                "message" => "Phone is already exist"
            ]);
        }

        if($email == $exitsUser->email && $id != $exitsUser->id){
            return response()->json([
                "success" => false,
                "message" => "Email is already exist"
            ]);
        }

        if($validator->fails()){
            return response()->json([
                "success" => false,
                "message" => "Form invalid",
                "data" => $validator->errors()
            ], 400);
        }

        $employee = Employee::find($id);
        $employee->name = $payload['name'];
        $employee->address = $payload['address'];
        $employee->gender = $payload['gender'];
        $employee->role_id = $payload['role_id'];
        $employee->birth_date = $payload['birth_date'];
        $employee->birth_place = $payload['birth_place'];
        $employee->phone = $payload['phone'];
        $employee->email = $payload['email'];
        $employee->image = $imageUrl;
        $employee->save();

        return response()->json([
            "success" => true,
            "message" => "Success update employee",
            "data" => array_merge($payload, ["image" => $imageUrl])
        ]);
    }

    public function delete($id){
        $delete = Employee::destroy($id);
        
        if(!$delete){
            return response()->json([
                "success" => false,
                "message" => "Failed to delete data id $id",
                "data" => $id
            ]);
        }

        return response()->json([
            "success" => true,
            "message" => "Success delete data id $id",
            "data" => $id
        ]);
    }

    public function loginView(){
        return view('login.login');
    }
}
