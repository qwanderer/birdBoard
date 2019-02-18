<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PDO;

class CreateDB extends Command
{
    use PDOConnection;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the database for the current env';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $database = env('DB_DATABASE', false);

        if (! $database) {
            $this->info('Skipping creation of database as env(DB_DATABASE) is empty');
            return;
        }

        try {
            $pdo = $this->getPDOConnection(env('DB_HOST'), env('DB_PORT'), env('DB_USERNAME'), env('DB_PASSWORD'));
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $pdo->exec(sprintf('CREATE DATABASE IF NOT EXISTS %s;', $database));

            $this->info(sprintf('Successfully created %s database', $database));
        } catch (\PDOException $exception) {
            $this->error(sprintf('Failed to create %s database, %s', $database, $exception->getMessage()));
        }
    }
}
