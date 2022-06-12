<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Order_details;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('orders.index');
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
        try {
            $order = Order::findOrFail($id);
            $vehicle = Vehicle::where('id', $request->vehicle_id)->first();
            switch ($request->order_status) {
                case 'loading':
                    # code...
                    $order->update(['status' => 'loading', 'vehicle_id' => $request->vehicle_id]);
                    $vehicle->update(['status' => 'loading']);
                    break;
                case 'dispatched':
                    # code...
                    $order->update(['status' => 'dispatched']);
                    $vehicle->update(['status' => 'transit']);
                    break;
                case 'delivered':
                    # code...
                    $order->update(['status' => 'delivered']);
                    $vehicle->update(['status' => 'available']);
                    break;
                default:
                    $order->update(['status' => 'pending']);
                    $vehicle->update(['status' => 'available']);
                    break;
            }
            $res = [
                'status' => 200,
                'message' => 'Order updated successfully!'
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

    public function fetch_orders()
    {
        try {
            $orders = Order::latest()->with(['customers', 'details', 'vehicles'])->get();
            $res = [
                'status' => 200,
                'orders' => OrderResource::collection($orders),
            ];
            return response()->json($res, 200);
        } catch (\Throwable $th) {
            $res = [
                'status' => 500,
                'orders' => $th->getMessage(),
            ];
            return response()->json($res, 500);
        }
    }

    public function fetch_order_details($id)
    {
        try {
            $items = Order_details::where('order_id', $id)->with('products')->get();
            $res = [
                'status' => 200,
                'items' => $items
            ];
            return response()->json($res, 200);
        } catch (\Throwable $th) {
            $res = [
                'status' => 500,
                'items' => $th->getMessage()
            ];
            return response()->json($res, 500);
        }
    }
}