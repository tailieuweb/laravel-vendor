<?php namespace Foostart\Acl\Database;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\App;

/**
 * Class UserSeeder
 *
 * @author Foostart foostart.com@gmail.com
 */

class UserSeeder extends Seeder
{
    protected $admin_email = "admin@admin.com";
    protected $admin_password = "password";

    public function run()
    {
        $user_repository = App::make('user_repository');
        $group_repository = App::make('group_repository');
        $profile_repository = App::make('profile_repository');

        // Clear user data before create sample user data
        $user_repository->truncate();
        // Clear user profile data create  sample user profile
        $profile_repository->truncate();
        for ($i = 0; $i < 100; $i++) {
            $u = ($i > 0) ? $i : '';
            $user_data = [
                "email" => $this->admin_email . $u,
                "password" => $this->admin_password,
                "activated" => 1
            ];

            $user = $user_repository->create($user_data);
            $profile_repository->attachEmptyProfile($user);

            if ($i == 0) {
                $superadmin_group = $this->getSuperadminGroup($group_repository);
                $user_repository->addGroup($user->id, $superadmin_group->id);
            }
        }

    }

    /**
     * @param $group_repository
     * @return mixed
     */
    private function getSuperadminGroup($group_repository)
    {
        $superadmin_group = $group_repository->all(["name" => "superadmin"])->first();
        return $superadmin_group;
    }
}
