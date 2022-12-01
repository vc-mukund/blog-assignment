<?php

namespace App\Services\Backend\User;

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
     * @return void
     */
    public function __construct(
        protected User $user,
        protected Role $role,
    ) {
    }

    /**
     * For show all user data with search functionalty.
     *
     * @return object
     */
    public function userList(): object
    {
        try {
            return $this->user->get();
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
    public function findUser(int $id): User
    {
        try {
            $user = $this->user->findOrFail($id);

            return $user;
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    /**
     * For fetch all roles of users
     *
     * @return object
     */
    public function roleList(): object
    {
        try {
            return $this->role->all();
        } catch(\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    /**
     * For create and update user.
     *
     * @param  array  $data
     * @return void
     */
    public function userStore(array $data)
    {
        DB::beginTransaction();
        try {
            $storeArr = [
                'fname' => $data['fname'],
                'lname' => $data['lname'],
                'email' => $data['email'],
                'dob' => $data['dob'],
                'verified' => $data['verify'],
            ];
            if (isset($data['password']) && !empty($data['password'])) {
                $storeArr['password'] = Hash::make($data['password']);
            }

            $user = $this->user->updateOrCreate(
                ['id' => $data['id']],
                $storeArr
            );

            $user->syncRoles($data['role']);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());
        }
        DB::commit();
    }
}
