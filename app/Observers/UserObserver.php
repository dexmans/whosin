<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;
use TID\Observers\BaseObserver;

class UserObserver extends BaseObserver
{
    private $hasher;

    public function __construct(HasherContract $hasher)
    {
        $this->hasher = $hasher;
    }

    public function saving(User $user)
    {
        if ($user->isDirty('password')) {
            $user->password = $this->hasher->make($user->password);
        }
    }
}
