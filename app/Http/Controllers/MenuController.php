<?php

namespace App\Http\Controllers;

use App\Helpers\Uploader;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Menu;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    private $carbonDate;

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['menuView']]);
        $this->carbonDate = Carbon::now();
    }   

    public function menuView() {
        return view('menu.menu');
    }

    public function index(){
        $data = DB::table('menu')->select('menu.*', 'category.name as category_name')
        ->leftJoin('category', 'menu.category_id', '=', 'category.id');

        return DataTables::of($data)->make(true);
    }

    public function store(Request $req){
        $payload = $req->all();
        $imageUrl = null;
        $rules = [
            'name' => 'required',
            'status_stock' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image',
            'created_by' => 'required',
            'category_id' => 'required|numeric',
            'description' => 'required'
        ];

        $validator = Validator::make($payload, $rules, [
            'required' => "The field :attribute is required",
            'image' => "The field :attribute must be image (jpg, jpeg, png, bmp, gif, svg, or webp)",
            'numeric' => "The field :attribute must be number"
        ]);

        if($validator->fails()){
            return response()->json([
                "success" => false,
                "message" => "Form invalid",
                "data" => $validator->errors()
            ], 400);
        }

        if($req->hasFile('image')){
            $imageUrl = Uploader::uploadToS3('menu', $payload['image'], $payload['image']->getClientOriginalName());
        }

        $query = Menu::create(array_merge($payload, ['image' => $imageUrl]));
        
        return response()->json([
            "success" => true,
            "message" => "Success add new menu",
            "data" => $query
        ]);
    }

    public function detail($id){
        $menu = Menu::find($id);

        if(!$menu){
            return response()->json([
                'sucess' => false,
                'message' => "Menu with ID $id is not found",
                'data' => $menu
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Success fetch menu with id :id',
            'data' => $menu
        ]);
    }

    public function categories(){
        $data = Category::all();

        return response()->json([
            "success" => true,
            "message" => "Success fetch categories",
            "data" => $data
        ]);
    }

    public function delete($id){
        $query = Menu::destroy($id);

        if($query){
            return response()->json([
                'success' => true,
                'message' => "Success delete data",
                'data' => null
            ]);
        }else{
            return response()->json([
                'success' => true,
                'message' => "Fail delete data",
                'data' => null
            ], 400);
        }
    }

    public function approveMenu($id){
        $menu = Menu::find($id);

        if (auth()->user()->role_id == 1) {
            $menu->status = 'approve';
            $menu->approved_by = auth()->user()->name;
            $menu->approved_at = $this->carbonDate->toDateString();
            $menu->reason = null;
            $menu->rejected_by = null;
            $menu->rejected_at = null;
            $menu->save();

            return response()->json([
                'success' => true,
                'message' => "Menu has been approved",
                'data' => null
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => "Only administrator can change status",
                'data' => null
            ], 401);
        }
    }

    public function rejectMenu(Request $req, $id){
        $menu = Menu::find($id);

        if (auth()->user()->role_id == 1) {
            $menu->status = 'reject';
            $menu->approved_by = null;
            $menu->approved_at = null;
            $menu->rejected_by = auth()->user()->name;
            $menu->rejected_at = $this->carbonDate->toDateString();
            $menu->reason = $req->reason;
            $menu->save();

            return response()->json([
                'success' => true,
                'message' => "Menu has been rejected",
                'data' => null
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => "Only administrator can change status",
                'data' => null
            ], 401);
        }
    }

    public function changeStatusStock(Request $req, $id){
        Menu::where('id', $id)->update(
            [
                'status_stock' => $req->status_stock
            ]
        );

        return response()->json([
            'success' => true,
            'message' => "Menu stock successfully update",
            'data' => null
        ]);
    }

    public function update(Request $req, $id){
        $payload = $req->all();
        $imageUrl = null;
        $rules = [
            'name' => 'required',
            'status_stock' => 'required',
            'price' => 'required|numeric',
            'created_by' => 'required',
            'category_id' => 'required|numeric',
            'description' => 'required'
        ];

        $validator = Validator::make($payload, $rules, [
            'required' => "The field :attribute is required",
            'numeric' => "The field :attribute must be number"
        ]);

        if($validator->fails()){
            return response()->json([
                "success" => false,
                "message" => "Form invalid",
                "data" => $validator->errors()
            ], 400);
        }

        if($req->hasFile('image')){
            $imageUrl = Uploader::uploadToS3('menu', $payload['image'], $payload['image']->getClientOriginalName());
        } else {
            $imageUrl = $payload['imageUrl'];
        }

        unset($payload['imageUrl']);

        $query = Menu::where('id', $id)->update(array_merge($payload, ['image' => $imageUrl]));
        
        return response()->json([
            "success" => true,
            "message" => "Success update menu",
            "data" => $query
        ]);
    }
}