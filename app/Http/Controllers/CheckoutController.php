<?php

namespace App\Http\Controllers;

use App\Http\Controllers\helpers\HelperController;
use App\Models\Order;
use App\Models\Order_details;
use App\Models\User;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('products.checkout');
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
        try {
            //store user
            $password = HelperController::generate_unique_string();
            $user_data = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'country' => $request->country,
                'city' => $request->city,
                'zip' => $request->zip,
                'scope' => 'customer',
                'password' => Hash::make($password),
            ];
            $user = User::where('email', $request->email)->first();
            if ($user) {
                $user->update(array_merge($user_data));
            } else {
                $user = User::create(array_merge($user_data));
                //assign role
                $user->assignRole('Customer');
            }

            //store order
            $order_data = [
                'user_id' => $user->id,
                'order_no' => HelperController::generate_unique_string(),
                'order_date' => now(),
                'payment_method' => $request->payment_method,
                'total_cost' => Cart::getSubTotal(),
            ];
            $order = Order::create(array_merge($order_data));
            //store order details
            $items = Cart::getContent();
            foreach ($items as $key => $item) {
                $detail = new Order_details();
                $detail->order_id = $order->id;
                $detail->product_id = $item->id;
                $detail->quantity = $item->quantity;
                $detail->save();
            }
            //clear cart
            Cart::clear();
            //send email
            $message = 'Dear ' . $request->name . ' Your order has been received successfully. Use the details below to monitor the progress of your order. </br></br> <h3>Login details</h3><p> Email: ' . $request->email . '<br/>Password: ' . $password . '</p>';
            $url = route('index');
            $subject = 'Order Confirmation';
            $send_email = EmailsController::send_email($message, $url, $subject, $user->email);
            if ($send_email) {
                $res = [
                    'status' => 200,
                    'message' => 'Your order has been submitted directly, check your email for more details'
                ];
                return response()->json($res, 200);
            } else {
                $res = [
                    'status' => 200,
                    'message' => 'Your order has been submitted directly, check your email for more details, Though'
                ];
                return response()->json($res, 200);
            }
        } catch (\Throwable $th) {
            $res = [
                'status' => 500,
                'message' => $th->getMessage()
            ];
            return response()->json($res, 500);
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
}
