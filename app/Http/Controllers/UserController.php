<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function edit(User $user) {
        $this->userAccess($user);

        return view('users.edit', [
            'user' => $user,
        ]);
    }

    public function update(Request $request, User $user) {
        $this->userAccess($user);
        $attributes = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
        ]);

        if($request->has('new_password')) {
            $attributes['password'] = Hash::make($request->new_password);
        }

        $user->update($attributes);

        return redirect()->back();
    }

    private function userAccess(USer $user): void {
        if(auth()->user()->id  !== $user->id) {
            abort(404);
        }
    }
}
