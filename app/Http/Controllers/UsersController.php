<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\TryCatch;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }
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
            $res['data'] = User::orderBy('id', 'DESC')->get();
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
        $res = [
            'data' => [],
            'message' => 'User Created',
            'success' => true
        ];

        try{

            $userData = $request->except('id');
            //$userData['password'] =  $userData['password'] ?? 'dededede';
            $userData['password'] = \Hash::make($userData['password']);
            $user = new User();
            //$user->phone = $request->input('phone'); per il singolo dato
            $user->fill($userData);
            $user->save();
            $res['data'] = $user;

        } catch (\Exception $e) {
            $res = [
                'data' => [],
                'message' => $e->getMessage(),
                'success' => false
            ];
        }
        return $res;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */

    public function show($user)
    {
        $res = [
            'data' => [],
            'message' => ''
        ];
        try {
            $res['data'] = User::findOrFail($user);
        } catch (\Exception $e) {
            $res['message'] = $e->getMessage();
        }
        return $res;
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
        $res = [
            'data' => $user,
            'message' => 'user' . $user->id .'deleted',
            'success' => true
        ];
        try {

            $res['success'] = $user->delete();

            if (!$res['success']) {
                $res['message'] = 'Could not delete $user' . $user->id;
            }

        } catch (\Exception $e) {

            $res['success'] = false;
            $res['message'] = $e->getMessage();
        }
        return $res;
    }
}
