<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('index');
    }

    public function profile($id)
    {
        $user = User::find($id);

        return view('profile', compact('user'));
    }

    public function datauser()
    {
        $data = User::all();
        // $data = User::where();

        return response()->json($data);
    }

    public function update(Request $request)
    {
        $user = User::find($request->id);
        $user->update([
            'name'     => $request->name,
            'username'     => $request->username,
            'email'     => $request->email,
            'nohp'     => $request->nohp,
            'tgl_lahir'     => $request->tgl_lahir
        ]);

        if ($request->file('foto')!=null) {
            Storage::disk('pp')->delete(''.$user->foto);
            $extension = $request->file('foto')->extension();
            Storage::disk('pp')->put($user->noktp.'.'.$extension, file_get_contents($request->file('foto')));
            $user->update([
            'foto'     => $user->noktp.'.'.$extension
        ]);
        }

        return redirect()->back();
    }

    public function pass(Request $request)
    {
        $user = User::find($request->id);
            
        $user->update([
            'password'     => bcrypt($request->password)
        ]);
    
        return redirect()->back();
    }

    public function pass1(Request $request)
    {   

        $this->validate($request, [
                'password' => 'required|string|min:8|different:current_password|confirmed',
                'password_confirmation' => 'required|string|min:8',
            ],[
                'password.different' => 'Gunakan password yang berbeda dari current password!',
                'password.confirmed' => 'Kedua kolom tidak sama!',
                'password.min' => 'Password tidak boleh kurang dari 8 karakter!',
                'password_confirmation.min' => 'Password tidak boleh kurang dari 8 karakter!',
            ]);

        $user = User::find($request->id);
            
        $user->update([
            'password'     => bcrypt($request->password)
        ]);
    
        return redirect()->back()->with('message', 'Password anda telah diganti');
    }

    public function update1(Request $request)
    {
        $this->validate($request, [
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255'],
            'username'  => ['required', 'string', 'max:255'],
            'nohp'      => ['required', 'numeric'],
            'foto'      => ['image', 'max:1024']
        ],[
            'email.unique' => 'Email sudah dipakai!',
            'username.unique' => 'Username sudah dipakai!',
            'nohp.numeric' => 'Isi nomor HP menggunakan angka!',
            'nohp.unique' => 'Nomor HP sudah dipakai!',
            'foto.max'      => 'Ukuran file tidak boleh melebihi 1MB!',
        ]);

        // dd($request->id);
        $user = User::find($request->id);
        $user->update([
            'name'     => $request->name,
            'email'     => $request->email,
            'username'     => $request->username,
            'nohp'     => $request->nohp,
            'tgl_lahir'     => $request->tgl_lahir
        ]);

        if ($request->file('foto')!=null) {
            Storage::disk('pp')->delete(''.$user->foto);
            $extension = $request->file('foto')->extension();
            Storage::disk('pp')->put($user->noktp.'.'.$extension, file_get_contents($request->file('foto')));
            $user->update([
            'foto'     => $user->noktp.'.'.$extension
        ]);
        }

        return redirect()->back()->with('message', 'Data anda berhasil diganti!');
    }

    public function destroy(request $request)
    {
        $user = User::find($request->id);
        Storage::disk('pp')->delete(''.$user->foto);
        $user->delete();

        return redirect()->back()->with('message', 'Data Terhapus!');
    }

    // public function destroy($id)
    // {
    //     $user = User::find($id);
    //     Storage::disk('pp')->delete(''.$user->foto);
    //     $user->delete();

    //     return redirect('/');
    // }
}
