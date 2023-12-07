<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = "/";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username'  => ['required', 'string', 'max:255', 'unique:users'],
            'noktp'     => ['required', 'numeric', 'unique:users'],
            'nohp'      => ['required', 'numeric', 'unique:users'],
            'password'  => ['required', 'string', 'min:8'],
            'foto'      => ['required', 'image', 'max:1024']
        ],[
            'email.unique' => 'Email sudah dipakai!',
            'username.unique' => 'Username sudah dipakai!',
            'noktp.numeric' => 'Isi nomor KTP menggunakan angka!',
            'noktp.unique' => 'Nomor KTP sudah dipakai!',
            'nohp.numeric' => 'Isi nomor HP menggunakan angka!',
            'nohp.unique' => 'Nomor HP sudah dipakai!',
            'foto.max'      => 'Ukuran file tidak boleh melebihi 1MB!',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */

    protected function create(array $data)
    {
        if ($data['foto']) {
            $extension = $data['foto']->extension();
            Storage::disk('pp')->put($data['noktp'].'.'.$extension, file_get_contents($data['foto']));
        }
        
        return User::create([
            'name'      => $data['name'],
            'username'  => $data['username'],
            'email'     => $data['email'],
            'nohp'      => '62'.$data['nohp'],
            'noktp'     => $data['noktp'],
            'tgl_lahir' => $data['tgl_lahir'],
            'password'  => Hash::make($data['password']),
            'foto'      => $data['noktp'].'.'.$extension
        ]);
    }
}
