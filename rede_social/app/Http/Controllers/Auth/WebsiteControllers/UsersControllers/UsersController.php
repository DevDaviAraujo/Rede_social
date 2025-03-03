<?php

namespace App\Http\Controllers\Auth\WebsiteControllers\UsersControllers;

use app\Http\Controllers\Auth\WebsiteControllers\ImagesControllers\ImagesController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;
use App\Models\UsersInfo;
use Illuminate\Support\Facades\DB;
class UsersController extends Controller
{
    public function saveUser($data)
    {

        DB::beginTransaction();

        try {

            if (isset($data["id"])) {

                $user = Users::where('id', $data['id'])->first();
                $info = $user->user_info;

                $user->update([

                    'email' => $data['email'],
                    'bio' => $data['bio'],

                ]);

                $info->update([
                    
                    'name' => $data['name'],
                    'last_name' => $data['last_name'],
                    'phone_number' => $data['phone_number'],
                    'gender' => $data['gender'], 
                    
                ]);

            } else {

                $user = Users::create([

                    'nick_name' => '@' . $data['nick_name'],
                    'email' => $data['email'],
                    'bio' => 'Olá, eu sou novo por aqui!',
                    'password' => Hash::make($data['password']),
                    'logout_at' => now()

                ]);

                $user_info = UsersInfo::create([
                    'users_id' => $user->id,
                    'name' => $data['name'],
                    'last_name' => $data['last_name'],
                    'phone_number' => $data['phone_number'],
                    'gender' => $data['gender'],
                ]);

            }

            DB::commit();

            return [
                'status' => 'success',
                'message' => 'Dados Salvos com Sucesso!'
            ];

        } catch (\Exception $e) {

            DB::rollBack();

            return [
                'status' => 'error',
                'error' => 'Algo deu errado, tente novamente.'
            ];
        }
    }

}
