<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //return User::all(); //mostra una strnga json

        // $res['data'] = User::all();

        // return $res;
        $res = [
            'data' =>[],
            'message' => '',
            'success' => true
        ];
        try{
            $res['data'] = User::all();
        } catch (\Exception $e){
            $res['message'] = $e->getMessage();
            $res['success'] = false;
        }
        return $res;
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //return $user;
        $res = [
            'data' => [],
            'message' => '',
            'success' => true
        ];
        try {
            //$res['data'] = User::where('id', $user)->get();
            $res['data'] = User::where('id', 1)->first();
            //dd($res);

        } catch (\Exception $e) {
            $res['message'] = $e->getMessage();
            $res['success'] = false;
        }

        return $res;




        // $res['data'] = User::findOrFail($user);

        // return $res;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user)
    {
        $data = $request->except(['id']);
        $res = [
            'data' => null,
            'message' => '',
            'success' => true
        ];

        try {

            $data['password'] = 'dededede';
            //$data['password'] = Hash::make($data['password']);


            $User = User::findOrFail($user);
            $User->update($data);
            $res['data'] = $User;

            $res['message'] = 'User updated!';

        } catch (\Exception $e) {
            $res['success'] = false;
            $res['message'] = $e->getMessage();
        }
        return $res;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
