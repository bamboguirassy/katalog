<?php

namespace App\Http\Controllers;

use App\Mail\NewUserSigned;
use App\Models\User;
use Dotenv\Validator;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $request->validate([
            'name'=>'required|min:3',
            'password'=>'confirmed|min:6',
            'email'=>'email|unique:users,email',
            'telephone'=>'required|min:9'
            ]
        );
        DB::beginTransaction();
        try {
            $user = $request->all();
            $user['password']=Hash::make($request->get('password'));
            $user['type']='client';
            $user = User::create($user);
            DB::commit();
            Mail::to($user->email)->send(new NewUserSigned($user, $request->get('password')));
        } catch(Exception $e) {
            DB::rollback();
            throw $e;
        }
        Auth::attempt($request->only(['email','password']));
        return back();
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
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        $request->validate([
            'name'=>'required|min:3',
            'profession'=>'required'
            ]);
        $user->update($request->all());
        return redirect()->route('account_route');
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
