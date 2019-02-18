<?php
namespace App\Console\Commands;

trait PDOConnection
{
    private function getPDOConnection($host, $port, $username, $password)
    {
        return new \PDO(sprintf('mysql:host=%s;port=%d;', $host, $port), $username, $password);
    }
}
