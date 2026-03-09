<?php

namespace App\Service\Impl;

use App\Repositories\UserRepository;
use App\Service\UserService;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserServiceImpl implements UserService
{
    protected $user;

    /**
     * @param $user
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function getData($search = '')
    {
        try {
            return $this->user->getData($search);
        }catch (Exception $e){
            Log::error($e->getMessage());
            return [];
        }
    }

    public function store(mixed $data)
    {
        try {
            $data['password'] = Hash::make($data['password']);
            return $this->user->store($data);
        }catch (Exception $e){
            Log::error($e->getMessage());
            return false;
        }
    }

    public function update(mixed $data, $id)
    {
        try {
            if (!empty($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            }else {
                unset($data['password']);
            }
            return $this->user->update($data, $id);
        }catch (Exception $e){
            Log::error($e->getMessage());
            return false;
        }
    }

    public function destroy($id)
    {
        try {
            return $this->user->destroy( $id);
        }catch (Exception $e){
            Log::error($e->getMessage());
            return false;
        }
    }

    public function getUserById($id)
    {
        try {
            return $this->user->getUserById($id);
        }catch (Exception $e){
            Log::error($e->getMessage());
            return [];
        }
    }
}
