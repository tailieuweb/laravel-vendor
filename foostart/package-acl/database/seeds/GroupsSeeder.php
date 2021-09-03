<?php namespace Foostart\Acl\Database;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\App;

/**
 * Class GroupsSeeder
 *
 * @author Foostart foostart.com@gmail.com
 * @property mixed group_repository
 */
class GroupsSeeder extends Seeder
{

    public function run()
    {
        $group_repository = App::make('group_repository');

        $group1 = [
            "name" => "superadmin",
            "permissions" => ["_superadmin" => 1]
        ];

        $group_repository->create($group1);

        $group2 = [
            "name" => "editor",
            "permissions" => ["_user-editor" => 1, "_group-editor" => 1]
        ];

        $group_repository->create($group2);

        $group3 = [
            "name" => "base admin",
            "permissions" => ["_user-editor" => 1]
        ];

        $group_repository->create($group3);

    }
}
