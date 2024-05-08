<?php

namespace App\Http\Controllers;

use App\Models\ProfileRS;
use App\Http\Requests\StoreProfileRSRequest;
use App\Http\Requests\UpdateProfileRSRequest;
use Illuminate\Http\Request;

class ProfileRSController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile = ProfileRS::first();

        if(!$profile){
            return view('profile_rs/v_profile_rs');
        }else{
            return view('profile_rs/edit_profile_rs' , compact('profile'));
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        ProfileRS::create([
            'nama_rs' => $request->nama_rs,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'informasi_rs' => $request->informasi_rs,
        ]);
        return redirect('/profile-rs');   
    }

    /**
     * Display the specified resource.
     */
    public function show(ProfileRS $profileRS)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProfileRS $profileRS)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfileRSRequest $request, ProfileRS $profileRS)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProfileRS $profileRS)
    {
        //
    }
}
