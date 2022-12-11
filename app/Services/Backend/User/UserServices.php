<?php

namespace App\Services\Backend\User;

use App\Constant\Constant;
use App\Events\CreateUserEvent;
use App\Services\Core\Services;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

/**
 * This services provide different method such as 
 * find specific existing resource, 
 * fetch all resoure, 
 * create newly and update existing resouce.  
 */
class UserServices extends Services
{
    /**
     * UserService Constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->modelUser = config('model-variable.models.user.class');
        $this->modelRole = config('model-variable.models.role.class');
    }

    /**
     * Fetch a listing of the users.
     *
     * @return object
     */
    public function userList(): object
    {
        try {
            return $this->modelUser::all();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    /**
     * For find existing user.
     *
     * @param  int  $id
     * @return Model
     */
    public function findUser(int $id): Model
    {
        try {
            return $this->modelUser::findOrFail($id);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    /**
     * Fetch listing of the roles.
     *
     * @return object
     */
    public function roleList(): object
    {
        try {
            return $this->modelRole::all();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    /**
     * Create a newly user and update existing user in storage.
     *
     * @param  array  $data
     * @return bool
     */
    public function userStore($data): bool
    {
        $response = Constant::STATUS_FALSE;
        DB::beginTransaction();
        try {
            $storeArr = [
                'fname' => $data['fname'],
                'lname' => $data['lname'],
                'email' => $data['email'],
                'dob' => $data['dob'],
                'verified' => $data['verified'],
            ];
            if (!isset($data['id']) && empty($data['id'])) {
                $storeArr['password'] = Hash::make($data['password']);
                event(new CreateUserEvent($data->only('fname', 'lname', 'email', 'password')));
            }
            $user = $this->modelUser::updateOrCreate(
                ['id' => $data['id']],
                $storeArr
            );
            $user->syncRoles($data['role']);

            DB::commit();
            $response = Constant::STATUS_TRUE;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());
        }

        return $response;
    }
}
