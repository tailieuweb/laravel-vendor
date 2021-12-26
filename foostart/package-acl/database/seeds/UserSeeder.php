<?php namespace Foostart\Acl\Database;

use Foostart\Acl\Library\Constants\FoostartConstants;
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
    protected $admin_password = "admin";
    protected $admin_user_name = "admin";

    public function run()
    {
        $user_repository = App::make('user_repository');
        $group_repository = App::make('group_repository');
        $profile_repository = App::make('profile_repository');

        // Clear user data before create sample user data
        $user_repository->truncate();
        // Clear user profile data create  sample user profile
        $profile_repository->truncate();

        $user_data = [
            "email" => $this->admin_email,
            "user_name" => $this->admin_user_name,
            "password" => $this->admin_password,
            "activated" => 1,
            'created_user_id' => 1,
            'updated_user_id' => 1
        ];
        $user = null;
        try {
            $user = $user_repository->create($user_data);
        }catch (\Throwable $e) {

        }

        $profile_repository->attachEmptyProfile($user);
        $superadmin_group = $this->getSuperadminGroup($group_repository);
        dd($superadmin_group);
        $user_repository->addGroup($user->id, $superadmin_group->id);


        $this->createSampleData();

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

    /**
     * Create sample data for testing
     */
    private function createSampleData() {

        $isCreateSampleData =  env('DB_SAMPLE_TEST', 0);
        if ($isCreateSampleData == FoostartConstants::IS_CREATE_SAMPLE_DATA) {

            $user_repository = App::make('user_repository');
            $group_repository = App::make('group_repository');
            $profile_repository = App::make('profile_repository');

            for($i = 1; $i < FoostartConstants::SAMPLE_DATA_SIZE; $i++) {
                $u = ($i > 0) ? $i : '';
                $user_data = [
                    "email" => $this->admin_email . $u,
                    "password" => $this->admin_password,
                    "activated" => 1,
                    'created_user_id' => 1,
                    'updated_user_id' => 1
                ];

                try {
                    $user = $user_repository->create($user_data);
                    $profile_repository->attachEmptyProfile($user);
                }catch (\Throwable $e) {
                }

            }
        }
    }
}
