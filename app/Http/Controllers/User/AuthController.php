<?php

namespace App\Http\Controllers\User;

use App\Exceptions\InvalidPasswordException;
use App\Exceptions\UserNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\UpdateUserRequest;
use App\Http\Requests\Auth\UpdatePasswordRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create(
            $request->validated()
        );

        return $this->success(new UserResource($user), __('model.created', ['model' => 'User']));
    }

    public function login(LoginRequest $request)
    {
        $user = User::whereEmail($request->email)->first();

        if (is_null($user)) {
            throw new UserNotFoundException();
        }

        if (!Hash::check($request->password, $user->password)) {
            throw new InvalidPasswordException();
        }

        $token = $user->createToken('API Token');

        return $this->success(compact('token', new UserResource($user)));
    }

    public function getProfile()
    {
        $user = auth()->user();

        return $this->success(new UserResource($user), 'Your Profile');
    }

    public function updateProfile(UpdateUserRequest $request)
    {
        $user = auth()->user();

        if (!$user->update($request->validated())) {
            return $this->error(__('model.could_not_update', ['model' => 'User']));
        }

        return $this->success(new UserResource($user), __('model.updated', ['model' => 'User']));
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = auth()->user();

        if (!Hash::check($request->old_password, $user->password)) {
            return $this->error(('The provided password is incorrect.'), 401);
        }

        if ($user->update(['password' => $request->new_password])) {
            return $this->success(__('model.updated', ['model' => 'Password']));
        }

        return $this->error(__('model.could_not_update', ['model' => 'Password']));
    }

    public function logout(Request $request)
    {
        $user = auth()->user();
        $user->tokens()->delete();

        return $this->success([], __('User logout successfully'));
    }
}
