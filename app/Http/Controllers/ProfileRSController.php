<?php

namespace App\Http\Controllers;

use App\Models\ProfileRS;
use App\Http\Requests\StoreProfileRSRequest;
use App\Http\Requests\UpdateProfileRSRequest;
use App\Mail\MailSend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

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

    public function pengguna(){
        $profile = ProfileRS::first();
        
        return view('pengguna/profile_rs' , compact('profile'));
    }

    public function contact(){
        $profile = ProfileRS::first();
        
        return view('pengguna/contact_rs' , compact('profile'));
    }

    public function send(Request $request){
        $details = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ];

        $profile = ProfileRS::first();

        Mail::to($profile->email)->send(new MailSend($details));

        return redirect()->back()->with('success', 'Pesan anda telah Dikirim!');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'logo_app' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Sesuaikan dengan kebutuhan Anda
        ]);
        
		// menyimpan data file yang diupload ke variabel $file
		$file = $request->file('logo_app');
 
		$nama_file = time()."_".$file->getClientOriginalName();
 
      	        // isi dengan nama folder tempat kemana file diupload
		$tujuan_upload = 'assets/images/logo';
		$file->move($tujuan_upload,$nama_file);
        $gambarPath = 'assets/images/logo/' . $nama_file;

        ProfileRS::create([
            'nama_rs' => $request->nama_rs,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'informasi_rs' => $request->informasi_rs,
            'logo_app' => $gambarPath,

        ]);
        return redirect('/profile-rs');   
    }

    public function update(Request $request)
    {
        $profile = ProfileRS::where('id', $request->id)->first();

        if ($profile->logo_app && $request->hasFile('logo_app')) {
            if (file_exists($profile->logo_app)) {
                // Hapus file
                unlink($profile->logo_app);
            }
        }
        $request->validate([
            'logo_app' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Sesuaikan dengan kebutuhan Anda
        ]);
        
		// menyimpan data file yang diupload ke variabel $file
		$file = $request->file('logo_app');

        if($request->file('logo_app')){
            $nama_file = time()."_".$file->getClientOriginalName();
 
      	        // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'assets/images/logo';
            $file->move($tujuan_upload,$nama_file);
            $gambarPath = 'assets/images/logo/' . $nama_file;
        }else{
            $gambarPath = $profile->logo_app;
        }

        ProfileRS::where('id', $request->id)->update([
            'nama_rs' => $request->nama_rs,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'informasi_rs' => $request->informasi_rs,
            'logo_app' => $gambarPath,

        ]);
        return redirect('/profile-rs');   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProfileRS $profileRS)
    {
        //
    }
}
