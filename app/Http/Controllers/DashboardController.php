<?php

namespace App\Http\Controllers;

use App\Http\Controllers\helpers\HelperController;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = HelperController::user_role();
        return view('dashboard', compact('role'));
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

    public function statistics()
    {
        try {
            $user = Auth::user();
            $orders = Order::get()->count();
            $customers = User::where('scope', 'customer')->get()->count();
            $latest_orders = [];
            if ($user->scope == 'admin') {
                $latest_orders = Order::with('customers')->latest()->take(6)->get();
            } else {
                $latest_orders = Order::where('user_id', $user->id)->with('customers')->latest()->take(6)->get();
            }

            $users = User::where('scope', 'admin')->get()->count();
            $total = Order::get()->sum('total_cost');
            $res = [
                'status' => 200,
                'orders' => $orders,
                'customers' => $customers,
                'latest_orders' => OrderResource::collection($latest_orders),
                'users' => $users,
                'total' => $total,
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