<?php namespace Foostart\Pexcel\Helper\User;

use Illuminate\Support\Facades\App;

class UserImport
{
    /**
     * Import user from external file
     * @param $users
     */
    public function importUsers($users) {
        $user_repository = App::make('user_repository');
        $profile_repository = App::make('profile_repository');

        for($i = 0; $i < count($users); $i++) {

            $user_data = [
                "email" => $users[$i]['email'],
                "password" => $users[$i]['username'],
                "activated" => 1
            ];
            try {
                $user = $user_repository->create($user_data);
                $profile_repository->attachEmptyProfile($user);
            } catch (\Throwable $e) {
                
            }

        }
    }

}
