<?php

namespace CodesRen\Breezify\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ],[
            'name.required' => 'Please enter your name',
            'name.string' => 'Please enter a valid name',
            'email.required' => 'Please enter your email address',
            'email.string' => 'Please enter a valid email address',
            'email.email' => 'Please enter a valid email address',
            'email.max' => 'Email address is too long',
            'password.required' => 'Please enter a password',
            'password.string' => 'Please enter a valid password',
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
