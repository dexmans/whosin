<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\UsersRepository;

class UserController extends RepositoryController
{
    /**
     * UserController constructor
     *
     * @param UsersRepository $usersRepository
     */
    public function __construct(UsersRepository $usersRepository)
    {
        $this->repository = $usersRepository;
    }

    /**
     * Profile
     *
     * @param  User  $user
     * @return \Illuminate\Http\Redirect
     */
    public function profile()
    {
        $user = auth()->user();

        // for now redirect
        return redirect()->route('users.edit', $user->id);
    }

    /**
     * Edit view
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // @todo Gate foo
        if (auth()->user()->id != $user->id) {
            abort(403);
        }

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserRequest  $request
     * @param  User         $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        // @todo Gate foo
        if (auth()->user()->id != $user->id) {
            abort(403);
        }

        $user->fill($request->all());
        $user->save();

        return redirect()->route('users.edit', $user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // @todo Gate foo
        if (auth()->user()->id != $user->id) {
            abort(403);
        }

        return redirect()->route('dashboard')
            ->with('error', 'lol nope');
    }
}
