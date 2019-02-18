<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use PDO;

class DropDB extends Command
{
    use PDOConnection;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:drop';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Drop the database for the current env';

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
        $database = env('DB_DATABASE', false);

        if (! $database) {
            $this->info('Skipping drop of database as env(DB_DATABASE) is empty');
            return;
        }

        try {
            $pdo = $this->getPDOConnection(env('DB_HOST'), env('DB_PORT'), env('DB_USERNAME'), env('DB_PASSWORD'));
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $pdo->exec(sprintf('DROP DATABASE %s;', $database));

            $this->info(sprintf('Successfully deleted %s database', $database));
        } catch (\PDOException $exception) {
            $this->error(sprintf('Failed to deleted %s database, %s', $database, $exception->getMessage()));
        }
    }
}
