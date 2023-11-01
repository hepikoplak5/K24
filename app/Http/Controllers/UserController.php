<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function register(Request $request)
    {
    	// dd($request->foto);
	    $this->validate($request, [
	        'foto'     => 'required|image|mimes:png,jpg,jpeg'
	    ]);

	    // //upload image
    	$extension = $request->file('foto')->extension();
	    Storage::disk('pp')->put($request->noktp.'.'.$extension, file_get_contents($request->file('foto')));

	    $user = User::create([
	        'name'     => $request->name,
	        'username'     => $request->username,
	        'email'     => $request->email,
	        'nohp'     => $request->nohp,
	        'noktp'     => $request->noktp,
	        'tgl_lahir'     => $request->tgl_lahir,
	        'password'     => bcrypt($request->password),
	        'foto'   => $request->noktp.'.'.$extension
	    ]);

	    if($user){
	        //redirect dengan pesan sukses
	        return redirect()->route('login')->with(['success' => 'Data Berhasil Disimpan! Silahkan login!']);
	    }else{
	        //redirect dengan pesan error
	        return redirect()->route('register')->with(['error' => 'Data Gagal Disimpan!']);
	    }
	}

    public function update(Request $request, $id)
    {
        $user = User::find($request->id);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        Storage::disk('pp')->delete(''.$user->foto);
        $user->delete();
        return redirect('/');
    }
}
