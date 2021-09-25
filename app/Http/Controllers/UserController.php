<?php

namespace App\Http\Controllers;

use App\Mail\NewUserSigned;
use App\Models\User;
use Exception;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

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
        $users = User::where('email',$request->get('email'))->get();
        if(count($users)) {
            return ['error'=>true,'message'=>"Cette adresse email est déja utilisée, impossible de procéder !"];
        }
        $request->validate([
            'name'=>'required|min:3',
            'password'=>'confirmed|min:6',
            'email'=>'email',
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
        if(Auth::attempt($request->only(['email','password']))) {
            $user = User::with(['shop'])->find(auth()->user()->id);
            return ['error'=>false,'data'=>$user];
        }
        return ['error'=>true,'message'=>'Identifiants de connexion invalides.'];
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
            ]);
        $user->update($request->except('email'));
        return back();
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

    public function updatePassword(Request $request) {
        Validator::validate($request->all(),
        [
            'currentPassword'=>'required',
            'password'=>'confirmed|min:6'
            ]
        );
        $user = User::find(Auth::user()->id);
        if(Hash::check($request->get('currentPassword'), $user->password)) {
            $hashedPassword = Hash::make($request->get('password'));
            $user->password = $hashedPassword;
            $user->update();
            event(new PasswordReset($user));
            return back()->with(['message'=>"Mot de passe mis à jour avec succès."]);
        } 
        return back()->withErrors(['error'=>"Le mot de passe actuel est incorrect..."]);
    }
}
