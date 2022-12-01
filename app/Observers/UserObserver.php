<?php

namespace App\Observers;

use App\Models\Log;
use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        $title = 'New User ['. $user->name . '] Created Successfully';
        $details = 'New User ['. $user->name . '] Crated. This user created# '. $user->created_at->diffForHumans();

        // Create log according to user creation
        Log::create([
            'title' => $title,
            'details' => $details,
            'user_id' => $user->id
        ]);
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        $title = 'User ['. $user->name . '] info updated Successfully';
        $details = 'User ['. $user->name . '] info updated. This user updated# '. $user->created_at->diffForHumans();

        // Create log according to user update
        Log::create([
            'title' => $title,
            'details' => $details,
            'user_id' => $user->id
        ]);

    }

    /**
     * Handle the User "deleting" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleting(User $user)
    {
        // When deleting user first delete associated log table data
        Log::where('user_id',$user->id)->delete();
    }
}
