<?php

namespace Orbitali\Database\Seeds;

use Silber\Bouncer\BouncerFacade;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BouncerFacade::allow('super_admin')->everything();

        BouncerFacade::allow('admin')->everything();
        BouncerFacade::forbid('admin')->toManage(config("auth.providers.users.model"));
    }
}
