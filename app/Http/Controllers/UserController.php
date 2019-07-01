<?php

namespace App\Http\Controllers;

use App\User;
use App\Traits\UserController\EvaluationTrait;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;

class UserController extends Controller
{

    use EvaluationTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::with(['rol'])->get();
        return view('user.index', compact('users'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $this->validate( $request, [
            'name'     => 'required|string',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6',
            'rut'      => 'required|cl_rut'
        ]);

        User::create( $request->all() );

        return redirect()->route('home', ['estado' => 'ok']);
    }

    public function show($id)
    {
        return response()->redirectToAction('UserController@edit', $id);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', compact('user') );
    }

    public function update(Request $request, $id)
    {
        $this->validate( $request, [
            'name'     => 'required|string',
            'email'    => 'required|email|unique:users,email,'.$id
        ]);

        $user = User::findOrFail($id);
        $user->update( $request->all() );
        return redirect()->route('user.edit', [$id, 'estado' => 'ok']);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('home', ['estado' => 'ok']);
    }

}
