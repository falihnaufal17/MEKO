<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Menu;

class MenuController extends Controller
{
    //
    public function index(){
        $data = Menu::query();

        return DataTables::of($data)->make(true);
    }

    public function create(Request $req){
        $payload = $req->all();

        $query = Menu::create($payload);

        if($query){
            return response()->json([
                "success" => true,
                "data" => $payload
            ]);
        }
    }
}
