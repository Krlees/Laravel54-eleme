<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class Product extends Controller{

    public function index()
    {
        return view('admin/product');
    }

    public function uploads(Request $request)
    {
        dd($request->all());
    }

}