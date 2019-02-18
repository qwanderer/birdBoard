<?php

namespace App\Console\Commands;

use App\Models\Admin;
use Illuminate\Console\Command;
use Psy\Exception\ErrorException;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin {username?} {password?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command created Admin';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $username = $this->argument('username');
        if (empty($username)) {
            $username = $this->ask('Enter username:');
        }
        $password = $this->argument('password');
        if (empty($password)) {
            $password = $this->secret('Enter password:');
            $passwordRepet = $this->secret('Repeat enter password:');
            if ($passwordRepet !== $password) {
                $this->error('Passwords do not match');
                exit;
            }
        }

        try {
            Admin::createAdmin($username, $password);
            $this->info('Created!');
        } catch (\Exception $exceptione) {
            $this->error($exceptione->getMessage());
        }
    }
}
