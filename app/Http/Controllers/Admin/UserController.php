<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdadeRequest;
use App\Services\UserServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * UserController Constructor
     */
    public function __construct(
        protected UserServices $services,
    ) {
    }

    /**
     * For listing of all users
     *
     * @param  Request  $request
     * @return Illuminate/View/View
     */
    public function index(Request $request)
    {
        try {
            $users = $this->services->userList($request->search);

            return view('admin.user.index', compact('users'));
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    /**
     * For show add user page.
     *
     * @return Illuminate View/View
     */
    public function create()
    {
        try {
            $roles = Role::all();

            return view('admin.user.add-user', compact('roles'));
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    /**
     * For Store user in database.
     *
     * @param  UserStoreRequest  $request
     * @return mixed
     */
    public function store(UserStoreRequest $request)
    {
        try {
            $this->services->userStore($request->all());

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
    public function edit($id)
    {
        try {
            $user = $this->services->findUser($id);
            $roles = Role::all();

            return view('admin.user.edit-user', compact('user', 'roles'));
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    /**
     * For update user.
     *
     * @param  UserUpdateRequest  $request
     * @return mixed
     */
    public function update(UserUpdadeRequest $request)
    {
        try {
            $this->services->userStore($request);

            return redirect()->route('admin.user.index');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    /**
     * For delete user from database
     *
     * @param  int  $id
     * @return mixed
     */
    public function delete($id)
    {
        try {
            $this->services->findUser($id)->delete();

            return redirect()->route('admin.user.index');
        } catch(\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }
}
