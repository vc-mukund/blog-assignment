<?php

namespace App\Http\Controllers\Backend\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\User\UserStoreRequest;
use App\Http\Requests\Backend\User\UserUpdadeRequest;
use App\Services\Backend\User\UserServices;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * UserController Constructor
     *
     * @param UserServices $services
     * @return void
     */
    public function __construct(
        protected UserServices $services,
    ) {
    }

    /**
     * For listing of all users
     *
     * @return Illuminate/View/View
     */
    public function index(): View
    {
        try {
            $users = $this->services->userList();

            return view('backend.admin.user.index', compact('users'));
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    /**
     * For show add user page.
     *
     * @return Illuminate View/View
     */
    public function create(): View
    {
        try {
            $roles = $this->roleList();

            return view('backend.admin.user.add-user', compact('roles'));
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    /**
     * For Store user in database.
     *
     * @param  UserStoreRequest  $request
     * @return RedirectResponse
     */
    public function store(UserStoreRequest $request): RedirectResponse
    {
        try {
            $this->services->userStore($request->only('id', 'fname', 'lname', 'email', 'password', 'dob', 'verified'));

            return redirect()->route('admin.user.index');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    /**
     * For show form for update user
     *
     * @param  int  $id
     * @return Iluminate/View/View
     */
    public function edit(int $id): View
    {
        try {
            $user = $this->services->findUser($id);
            $roles = $this->roleList();

            return view('backend.admin.user.edit-user', compact('user', 'roles'));
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    /**
     * For update user.
     *
     * @param  UserUpdateRequest  $request
     * @return RedirectResponse
     */
    public function update(UserUpdadeRequest $request): RedirectResponse
    {
        try {
            $this->services->userStore($request->only('id', 'fname', 'lname', 'email', 'password', 'dob', 'verified'));

            return redirect()->route('admin.user.index');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    /**
     * For delete user from database
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        try {
            $this->services->findUser($id)->delete();

            return redirect()->route('admin.user.index');
        } catch(\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }
}
