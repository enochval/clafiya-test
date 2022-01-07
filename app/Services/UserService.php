<?php


namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserService
{
    /**
     * @var User
     */
    private $user;

    /**
     * UserService constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function createUser($request)
    {
        $request['password'] = Hash::make($request['password']);
        $request['remember_token'] = Str::random(10);
        return User::create($request->toArray());
    }

    public function findByEmailOrPhone($query)
    {
        return User::when(is_numeric($query), function ($q) use ($query) {
            return $q->where('phone_number', $query);
        })->when(filter_var($query, FILTER_VALIDATE_EMAIL), function ($q) use ($query) {
            return $q->where('email', $query);
        })->first();
    }
}
