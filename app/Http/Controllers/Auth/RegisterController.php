<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Saldo;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required', 'string', 'max:255',
            'username' => 'required|unique:users,username',
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
            'nohp' => 'required',
            'alamat' => 'required',
            'photo' => 'required',
            'password' => 'required', 'string', 'min:8', 'confirmed',
        ]);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|unique:users,email',
            'nohp' => 'required',
            'password' => 'required',
            'alamat' => 'required',
        ]);

        $photo = $request->file('photo');
        $photo->storeAs('public/photo', $photo->hashName());

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'nohp' => $request->nohp,
            'photo' => $photo->hashName(),
            'alamat' => $request->alamat,
            'password' => Hash::make($request->password),
            'type' => 0,
        ]);

        $saldo = new Saldo;
        $saldo->nasabah_id = $user->id;
        $saldo->saldo = 0;
        $saldo->save();

        return redirect()->route('login')->with(['success' => 'Akun Berhasil dibuat']);
    }
}
