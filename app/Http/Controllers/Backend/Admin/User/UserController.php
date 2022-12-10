<?php

namespace App\Http\Controllers\Backend\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\User\UserStoreRequest;
use App\Http\Requests\Backend\User\UserUpdadeRequest;
use App\Services\Backend\User\UserServices;
use Illuminate\Http\RedirectResponse;
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
     * Display a listing of the users.
     *
     * @return View
     */
    public function index(): View
    {
        $users = $this->services->userList();

        return view('backend.admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     *
     * @return Illuminate View/View
     */
    public function create(): View
    {
        $roles = $this->services->roleList();

        return view('backend.admin.user.add-user', compact('roles'));
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  UserStoreRequest  $request
     * @return RedirectResponse
     */
    public function store(UserStoreRequest $request): RedirectResponse
    {
        $this->services->userStore($request);

        return redirect()->route('admin.user.index');
    }

    /**
     * Show the form for creating a new user.
     *
     * @param  int  $id
     * @return View
     */
    public function edit(int $id): View
    {
        $user = $this->services->findUser($id);
        $roles = $this->services->roleList();

        return view('backend.admin.user.edit-user', compact('user', 'roles'));
    }

    /**
     * For update specific user.
     *
     * @param  UserUpdateRequest  $request
     * @return RedirectResponse
     */
    public function update(UserUpdadeRequest $request): RedirectResponse
    {
        $this->services->userStore($request);

        return redirect()->route('admin.user.index');
    }

    /**
     * Update a existing user in storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        $this->services->findUser($id)->delete();

        return redirect()->route('admin.user.index');
    }
}
