<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\User;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ShopController extends Controller
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
        Validator::validate($request->all(),
        [
            'nom'=>'unique:shops,nom|required',
            'pseudonyme'=>'min:6|required|unique:shops,pseudonyme',
            'categorie_id'=>'required',
            'telephonePrimaire'=>"required",
            'description'=>'required',
            'adresse'=>'required',
            'email'=>'required|unique:shops,email',
            'password'=>'required|min:6|confirmed',
        ]);
        $user = new User();
        $user->name = $request->get('nom');
        $user->email = $request->get('email');
        $user->type = 'owner';
        $user->password = Hash::make($request->get('password'));
        $shop = new Shop($request->all());
        
        if($request->hasFile('logo')) {
            Validator::validate($request->only('logo'),['logo'=>'image']);
            // Filename To store
            $filename = $request->get('pseudonyme').'.'.$request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->storeAs('public/shops', $filename);
            $shop->logo = $filename;
        }
        
        try {
            DB::beginTransaction();
            $user->save();
            $shop->user_id = $user->id;
            $shop->save();
            DB::commit();
        } catch(\PDOException $e) {
            DB::rollBack();
            throw new Error("Une erreur est survenue pendant l'enregistrement !");
        }
        Auth::attempt($request->only(['email','password'],true));
        return redirect()->route('shop.categorie.index',['shop'=>$shop]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
        //
    }
}
