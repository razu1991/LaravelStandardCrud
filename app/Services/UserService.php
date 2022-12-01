<?php

namespace App\Services;

use App\Models\User;

class UserService
{

    /**
     * Fetch all users
     *
     * @param $request
     * @return mixed
     */
    public function getAllUsers($request)
    {
        $users = User::orderBy('id', 'desc');

        if ($request->has('name')) {
            $users = $users->where('name', 'like', "%$request->name%");
        }

        if ($request->has('email')) {
            $users = $users->where('email', 'like', "%$request->email%");
        }

        if ($request->has('phone')) {
            $users = $users->where('phone', 'like', "%$request->phone%");
        }

        if ($request->has('age')) {
            $users = $users->where('age', 'like', "%$request->age%");
        }

        if ($request->has('country')) {
            $users = $users->where('country', 'like', "%$request->country%");
        }

        return $users->orderBy('id', 'desc')->latest()->paginate(config('constants.global.pagination'))->appends(request()->query());
    }

    /**
     * Store user to database
     *
     * @param $request
     * @return mixed
     */
    public function storeUser($request)
    {
        // If the user has a sensitive column (ex: balance) don't use mass assignment or process data properly
        return User::create($request->all());
    }

    /**
     * Update user in database
     *
     * @param $request
     * @param $id
     * @return void
     */
    public function updateUser($request, $id)
    {
        $user = User::find($id);

        // If the user has a sensitive column (ex: balance) don't use mass assignment or process data properly
        $user->update($request->all());
    }

    /**
     * Delete user from database
     *
     * @param $id
     * @return void
     */
    public function deleteUser($id)
    {
        User::destroy($id);
    }

    /**
     * Process & filtered print user data
     *
     * @return array
     */
    public function printUserList()
    {
        $request = request();
        $name = '';
        $email = '';
        $phone = '';
        $age = '';
        $country = '';

        if ($request->name && $request->name != "null") {
             $name = $request->name;
        }

        if ($request->email && $request->email != "null") {
             $email = $request->email;
        }

        if ($request->phone && $request->phone != "null") {
             $phone = $request->phone;
        }

        if ($request->age && $request->age != "null") {
             $age = $request->age;
        }

        if ($request->country && $request->country != "null") {
             $country = $request->country;
        }

        return ['name' => $name, 'email' => $email, 'phone' => $phone, 'age' => $age, 'country' => $country];
    }


}
