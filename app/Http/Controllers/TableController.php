<?php

namespace App\Http\Controllers;

use App\Helpers\Uploader;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode as simpleQrCode;
use Yajra\DataTables\Facades\DataTables;

class TableController extends Controller
{
    //
    public function tableView() {
        return view('table.table');
    }

    public function index() {
        $data = Table::query();

        return DataTables::of($data)->make(true);
    }

    public function store(Request $req) {
        $payload = $req->all();
        $rules = [
            'number' => 'required|numeric'
        ];

        $validator = Validator::make($payload, $rules, [
            'numeric' => "The field :attribute must be number",
            'required' => "The field :attribute is required"
        ]);

        if($validator->fails()){
            return response()->json([
                "success" => false,
                "message" => "Form invalid",
                "data" => $validator->errors()
            ], 400);
        }

        $data = array_merge($payload, [
            'status' => 'available'
        ]);
        $addTable = Table::create($data);

        // generate qr code
        // give value qr code with hosts/tableId/:id, e.g: https://meko.com/tableId/3445
        $imageQrCode = simpleQrCode::format('png')->size(300)->generate(env('APP_URL').'/tableId/'.$addTable->id);
        
        // output file name qr code
        $output_file = 'qr-code/img-' . $addTable->id . '.png';
        $urlImage = Uploader::uploadQrCodeToS3($output_file, $imageQrCode);
        
        // update table and fill qrcode_image field with generate url from S3
        $updateTable = Table::where('id', $addTable->id)->update([
            'qrcode_image' => $urlImage,
            'url' => env('APP_URL').'/tableId/'.$addTable->id
        ]);

        return response()->json([
            "success" => true,
            "message" => "Success add new table",
            "data" => $updateTable
        ]);
    }

    public function delete($id) {
        $file_path = parse_url('qr-code/img-'.$id.'.png');
        Storage::disk('s3')->delete($file_path);

        Table::destroy($id);

        return response()->json([
            "success" => true,
            "message" => "Success delete table",
            "data" => null
        ]);
    }

    public function update(Request $req, $id) {
        $payload = $req->all();
        $rules = [
            'number' => 'required|numeric'
        ];

        $validator = Validator::make($payload, $rules, [
            'numeric' => "The field :attribute must be number",
            'required' => "The field :attribute is required"
        ]);

        if($validator->fails()){
            return response()->json([
                "success" => false,
                "message" => "Form invalid",
                "data" => $validator->errors()
            ], 400);
        }

        $updateTable = Table::where('id', $id)->update($payload);

        return response()->json([
            "success" => true,
            "message" => "Success update table",
            "data" => $updateTable
        ]);
    }

    public function detail($id) {
        $data = Table::find($id);

        return response()->json([
            "success" => true,
            "message" => "Success fetch data",
            "data" => $data
        ]);
    }
}
