<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RefreshDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh the database for the current env';

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
        $this->call('db:drop');
        $this->call('db:create');
        $this->call('migrate', [ '--seed' => true]);
    }
}
