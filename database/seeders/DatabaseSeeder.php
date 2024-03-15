<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public $adminPassword = '$2y$10$JcmAHe5eUZ2rS0jU1GWr/.xhwCnh2RU13qwjTPcqfmtZXjZxcryPO';
    public function run(): void
    {

       \DB::connection('mysql')->table('admins')->insert(
        [
            ['id' => '1', 'username' =>'superadmin','password' => $this->adminPassword, 'email' => 'superadmin@gmail.com', 'name' => 'Super Admin', 'created_at' => date('Y-m-d H:i:s')],
        ]
    );

        //permission seeder
       \DB::statement("
        INSERT INTO `permissions` (`id`, `name`, `access_uri`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
        (1, 'All System Control', '/*', NULL, NULL, '2022-07-04 21:22:16', '2022-07-04 21:22:16')");

        //role seeder
       \DB::statement("
        INSERT INTO `roles` (`id`, `name`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
        (1, 'Super Admin', NULL, NULL, '2022-07-04 21:23:23', '2022-07-04 21:23:23')");

        //role permission
       \DB::statement("
        INSERT INTO `role_permissions` (`id`, `role_id`, `permission_id`) VALUES
        (1, 1, 1)");

        //user role
       \DB::statement("INSERT INTO `admin_roles` (`id`, `role_id`, `admin_id`) VALUES
        (1, 1, 1)");


        //continent
       \DB::statement("
            INSERT INTO `continents` (`id`, `title`, `created_at`, `updated_at`) VALUES
            (1, 'Europe','2022-07-04 21:22:16', NULL),
            (2, 'Asia','2022-07-04 21:22:16', NULL),
            (3, 'Africa','2022-07-04 21:22:16', NULL),
            (4, 'North America','2022-07-04 21:22:16', NULL),
            (5, 'South America','2022-07-04 21:22:16', NULL),
            (6, 'Australia','2022-07-04 21:22:16', NULL),
            (7, 'Antarctical','2022-07-04 21:22:16', NULL)
        ");

       \DB::table('experiences')->insert([
            ['experience' => '0 to 1 years'],
            ['experience' => '1 to 2 years'],
            ['experience' => '2 to 3 years'],
            ['experience' => '3 to 4 years'],
            ['experience' => '4 to 5 years'],
            ['experience' => '5 to 6 years'],
            ['experience' => '6 to 7 years'],
            ['experience' => '7 to 8 years'],
            ['experience' => '8 to 9 years'],
            ['experience' => '9 to 10 years']
        ]);

   }
}
