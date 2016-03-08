<?php
/**
 * Created by PhpStorm.
 * User: Nicholas
 * Date: 2016/3/9
 * Time: 0:45
 */

namespace AGarage\Console\Commands;


use AGarage\Role;
use AGarage\User;
use Illuminate\Console\Command;

class InitCommand extends Command
{
    protected $name = 'init';
    protected $description = 'Initialize this site';

    public function handle() {
        $email = $this->ask('Admin account\'s email:');
        $nickname = $this->ask('Admin account\'s nickname:');
        REDO:
        $password = $this->ask('Admin account\'s password:');
        $confirmpassword = $this->ask('Confirm admin account\'s password:');
        if ($password !== $confirmpassword) {
            goto REDO;
        }
        $user = User::create([
            'email' => $email,
            'nickname' => $nickname,
            'password' => bcrypt($password)
        ]);
        $adminRole = new Role();
        $adminRole->name = 'admin';
        $adminRole->display_name = 'Admin';
        $adminRole->description = 'User is allowed to access and manage the whole site.';
        $adminRole->save();
        $user->attachRole($adminRole);
    }
}