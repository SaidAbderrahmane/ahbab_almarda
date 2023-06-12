<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Tiers;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('pages.auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'donor',
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    public function store_with_donor(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'pere' => 'required',
            'grand_pere' => 'required',
            'groupage' => 'required',
            'adresse' => 'required',
            'date_naissance' => 'required',
            'key_agherme' => 'required',
            'sexe' => 'required',
        ]);

        $donor = Tiers::create(
            [
                'nom_prenom' => strtoupper($request->input('name')),
                'pere' => strtoupper($request->input('pere')),
                'grand_pere' => strtoupper($request->input('grand_pere')),
                'groupage' => $request->input('groupage'),
                'adresse' => $request->input('adresse'),
                'date_naissance' => date('Y-m-d', strtotime($request->input('date_naissance'))),
                'key_agherme' => $request->input('key_agherme'),
                'code_barres' => $request->input('code_barres'),
                'sexe' => $request->input('sexe'),
                'key_tiers_type' => 2,
                'key_quartier' => 3
            ]
        );

        $user = User::create([
            'key_tiers' => $donor->key_tiers,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'donor',
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}