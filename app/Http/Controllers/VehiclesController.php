<?php

namespace App\Http\Controllers;

use App\Http\Resources\VehiclesResource;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehiclesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('vehicles.index');
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
            $data = [
                'name' => $request->name,
                'reg_no' => $request->reg_no
            ];
            Vehicle::create(array_merge($data));
            $res = [
                'status' => 200,
                'message' => 'Vehicle created successfully!'
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
            $veh = Vehicle::findOrFail($id);
            $data = [
                'name' => $request->name,
                'reg_no' => $request->reg_no
            ];
            $veh->update(array_merge($data));
            $res = [
                'status' => 200,
                'message' => 'Vehicle edited successfully!'
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
        try {
            Vehicle::findOrFail($id)->update(['state' => 'inactive']);
            $res = [
                'status' => 200,
                'message' => 'Vehicle delete successfullY!'
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

    public function fetch()
    {
        try {
            $vehicles = Vehicle::where('state', 'active')->latest()->get();
            $res = [
                'status' => 200,
                'vehicles' => VehiclesResource::collection($vehicles)
            ];
            return response()->json($res, 200);
        } catch (\Throwable $th) {
            $res = [
                'status' => 500,
                'vehicles' => $th->getMessage()
            ];
            return response()->json($res, 500);
        }
    }
}