<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:user {--e|email=test@test.ru} {--p|password=secret}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command created test User';

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
        (new \GraphSeeder($this->option('email'), $this->option('password')))->run();
    }
}
