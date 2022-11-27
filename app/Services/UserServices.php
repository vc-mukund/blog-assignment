<?php

namespace App\Services;

use App\Events\CreateUserEvent;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class UserServices
{
    /**
     * UserService Constructor
     *
     * @param  User  $user
     * @param  Role  $role
     */
    public function __construct(
        protected User $user,
        protected Role $role,
    ) {
    }

    /**
     * For show all user data with search functionalty.
     *
     * @param  string  $search
     * @return User $user
     */
    public function userList($search)
    {
        try {
            if (isset($search)) {
                $users = $this->user->Search($search)->get();
            } else {
                $users = $this->user->all();
            }

            return $users;
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    /**
     * For find specific user.
     *
     * @param  int  $id
     * @return User $user
     */
    public function findUser($id)
    {
        try {
            $user = $this->user->findOrFail($id);

            return $user;
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    /**
     * For store user in database.
     *
     * @param  array  $data
     * @return mixed
     */
    public function userStore($data)
    {
        try {
            if (isset($data['id'])) {
                $this->updateUser($data);
            } else {
                $this->createUser($data);

                event(new CreateUserEvent($data));
            }
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    /**
     * For create new user.
     *
     * @param  array  $data
     * @return User $user
     */
    public function createUser($data)
    {
        DB::beginTransaction();
        try {
            $user = $this->user->create([
                'fname' => $data['fname'],
                'lname' => $data['lname'],
                'email' => $data['email'],
                'dob' => $data['dob'],
                'verified' => $data['verify'],
                'password' => Hash::make($data['password']),
            ]);

            $user->assignRole($data['role']);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());
        }
        DB::commit();
    }

    /**
     * For update user.
     *
     * @param  array  $data
     * @return User $user
     */
    public function updateUser($data)
    {
        DB::beginTransaction();
        try {
            $user = $this->findUser($data['id']);
            $user->update([
                'fname' => $data['fname'],
                'lname' => $data['lname'],
                'email' => $data['email'],
                'dob' => $data['dob'],
                'verified' => $data['verify'],
            ]);

            $user->syncRoles($data['role']);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());
        }
        DB::commit();
    }
}
