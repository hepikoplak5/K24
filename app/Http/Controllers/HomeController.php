<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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

    public function update1(Request $request)
    {
        // dd($request->id);
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

        return redirect('/');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        Storage::disk('pp')->delete(''.$user->foto);
        $user->delete();

        return redirect('/');
    }
}
