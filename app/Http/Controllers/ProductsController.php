<?php

namespace App\Http\Controllers;

use App\Http\Controllers\helpers\HelperController;
use App\Http\Resources\ProductsResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = HelperController::user_role();
        return view('products.index', compact('role'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            if ($request->has('product_photo')) {
                $file = $request->file('product_photo');
                $filename = $file->getClientOriginalName();
                $file_extension = $file->getClientOriginalExtension();
                $file->move(public_path("photos"), $filename);
                $file_path = "/photos/" . $filename;
            }
            $data = [
                'product_name' => $request->product_name,
                'product_price' => $request->product_price,
                'availability' => $request->availability,
                'product_desc' => $request->product_desc,
                'product_photo' => $file_path
            ];
            Product::create(array_merge($data));
            $results = [
                'status' => 200,
                'message' => 'Product posted succesfully!'
            ];
            return response()->json($results, 200);
        } catch (\Throwable $th) {
            $results = [
                'status' => 500,
                'message' => $th->getMessage()
            ];
            return response()->json($results, 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function fetch()
    {
        try {
            $products = Product::latest()->get();
            $res = [
                'status' => 200,
                'products' => ProductsResource::collection($products)
            ];
            return response()->json($res, 200);
        } catch (\Throwable $th) {
            $res = [
                'status' => 500,
                'products' => $th->getMessage()
            ];
            return response()->json($res, 500);
        }
    }
}