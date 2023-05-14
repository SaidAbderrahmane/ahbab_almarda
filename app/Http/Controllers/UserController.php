<?php

namespace App\Http\Controllers;

use App\Models\Agherme;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = User::query();

        if (request()->order) {
            $orderBy = explode('-',request()->order)[0];
            $orderHow = explode('-',request()->order)[1];
        }else {
            $orderBy = "name";
            $orderHow = "asc";
        }
        $query->orderBy($orderBy,$orderHow);
        
        //search
        if (request()->q) {
            $q = request()->q;
           $query->where('name', 'like', "%$q%");
        }

       // $users = User::all()->toQuery()->paginate(30);
        $users = $query->paginate(30);
        $aghermes = Agherme::all();
        return view('pages.users.users', ['users' => $users,'aghermes'=>$aghermes]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'key_tiers' => [$request->role == 'donor' ? 'required' : null,],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', Rule::in(Config::get('constants.roles'))],
        ]);

        $user = User::create([
            'key_tiers' => $request->key_tiers,
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        // Auth::login($user);

        return redirect()->back()->with('success', 'User created successfully');
    }
    public function getUserById($id)
    {
        $user = User::find($id);
        $user['nom_prenom'] = $user->tiers->nom_prenom;
        $user['pere'] = $user->tiers->pere;
        return response()->json(['data' => $user]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'key_tiers' => [$request->role == 'donor' ? 'required' : null,],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'role' => ['required', Rule::in(Config::get('constants.roles'))],
        ]);
        $user = User::find($id);
        $user->update([
            'key_tiers' => $request->key_tiers,
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        return redirect()->back()->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::destroy($id);
        return redirect()->back()->with('success', 'User deleted successfully!');
    }
}