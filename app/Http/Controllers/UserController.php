<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Http\Requests\UserStoreFormValidation;
use App\Http\Requests\UserUpdateFormValidation;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class UserController extends Controller
{

    protected $userService;

    /**
     * Assign instance of user service class
     *
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the users.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $title = "User List | Standard CRUD 1.0";

        $request = request();

        // get user list from user service class
        $users = $this->userService->getAllUsers($request);

        if ($request->ajax()) {
            return view('utility.users')->with('users', $users);
        } else {
            return view('index', compact('users', 'title'));
        }

    }


    /**
     * Store user
     *
     * @param UserStoreFormValidation $request
     * @return mixed
     */
    public function store(UserStoreFormValidation $request)
    {
        // When user created auto user log/ activity created in UserObserver
        // Store user via user service class
        $this->userService->storeUser($request);

        $message[] = ['success', 'User added successfully'];
        return redirect()->back()->withNotify($message);
    }

    /**
     * Update the specified user.
     *
     * @param UserUpdateFormValidation $request
     * @param int $id
     * @return mixed
     */
    public function update(UserUpdateFormValidation $request, $id)
    {
        // When the user update auto user log/ activity created in UserObserver
        // Update user via user service class
        $this->userService->updateUser($request, $id);

        $message[] = ['success', 'User updated successfully'];
        return redirect()->back()->withNotify($message);
    }


    /**
     * Remove the specified user.
     *
     * @param int $id
     * @return mixed
     */
    public function destroy($id)
    {
        // Delete user via user service class
        $this->userService->deleteUser($id);

        $message[] = ['success', 'User deleted successfully'];
        return redirect()->back()->withNotify($message);
    }


    /**
     * Print user data in csv/pdf/excel format
     *
     * @param $type
     * @return BinaryFileResponse
     */
    public function printUser($type)
    {
        // Process/filtered users in user service class
        $info = $this->userService->printUserList();

        if ($type == 'csv') {
            return Excel::download(new UsersExport($info['name'], $info['email'], $info['phone'], $info['age'], $info['country']), "users.$type");
        } else if ($type == 'pdf') {
            return Excel::download(new UsersExport($info['name'], $info['email'], $info['phone'], $info['age'], $info['country']), "users.$type");
        } else {
            return Excel::download(new UsersExport($info['name'], $info['email'], $info['phone'], $info['age'], $info['country']), "users.xlsx");
        }

    }

}
