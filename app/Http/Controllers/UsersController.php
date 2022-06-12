<?php

namespace App\Http\Controllers;

use App\Http\Resources\UsersResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index');
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
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
        ]);
        if ($validator->fails()) {
            $result = [
                'status' => 400,
                'errors' => $validator->errors()
            ];
            return response()->json($result, 400);
        }
        try {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'scope' => 'admin',
                'password' => Hash::make($request->password),
            ];
            $user = User::create(array_merge($data));
            $user->assignRole('Admin');
            $res = [
                'status' => 200,
                'message' => 'User created successfully!',
            ];
            return response()->json($res, 200);
        } catch (\Throwable $th) {
            $res = [
                'status' => 500,
                'message' => $th->getMessage(),
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

    public function fetch()
    {
        try {
            $users = User::where('scope', 'admin')->latest()->get();
            $res = [
                'status' => 200,
                'users' => UsersResource::collection($users)
            ];
            return response()->json($res, 200);
        } catch (\Throwable $th) {
            $res = [
                'status' => 500,
                'users' => $th->getMessage()
            ];
            return response()->json($res, 200);
        }
    }
}