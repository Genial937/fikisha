<?php

namespace App\Http\Controllers;

use App\Http\Controllers\helpers\HelperController;
use App\Http\Resources\CartResource;
use App\Models\Product;
use Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('products.cart');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function addToCart(Request $request)
    {
        try {
            $id = $request->id;
            $product = Product::findOrFail($id);

            Cart::add(array(
                'id' => $id, // inique row ID
                'name' => $product->product_name,
                'price' => $product->product_price,
                'quantity' => 1,
                'attributes' => [],
                'associatedModel' => Product::class
            ));
            $res = [
                'status' => 200,
                'message' => 'Item added to cart!'
            ];
            return response()->json($res, 200);
        } catch (\Throwable $th) {
            $res = [
                'status' => 500,
                'message' => $th->getMessage()
            ];
            return response()->json($res, 500);
        }
    }

    public function count_cart()
    {
        try {
            $count = count(Cart::getContent());
            $res = [
                'status' => 200,
                'count' => $count
            ];
            return response()->json($res, 200);
        } catch (\Throwable $th) {
            $res = [
                'status' => 500,
                'count' => $th->getMessage()
            ];
            return response()->json($res, 500);
        }
    }

    public function fetch_cart()
    {
        try {
            $cart = Cart::getContent();
            $total = Cart::getSubTotal();
            $amount = Cart::getSubTotal();
            $res = [
                'status' => 200,
                'items' => CartResource::collection($cart),
                'total' => HelperController::number_format($total),
                'amount' => $amount
            ];
            return response()->json($res, 200);
        } catch (\Throwable $th) {
            $res = [
                'status' => 500,
                'message' => $th->getMessage()
            ];
            return response()->json($res, 500);
        }
    }
}