<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Telephone;
use App\Models\Tiers;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Validation\Rules;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = User::with('tiers')->find($request->user()->id);
        $contacts = Telephone::where('key_tiers', $request->user()->key_tiers)->get();
        return view('pages.profile.edit', [
            'user' => $user,
            'contacts' => $contacts
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {

        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        $request->validate([
            'nom_prenom' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'pere' => 'required',
            'grand_pere' => 'required',
            'groupage' => 'required',
            'adresse' => 'required',
            'date_naissance' => 'required',
            'key_agherme' => 'required',
            'sexe' => 'required',
        ]);

        Tiers::find($request->user()->key_tiers)->update(
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




        return Redirect::route('profile.edit')->with(['status'=>'profile-updated','success'=>'Profile updated successfully']);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}