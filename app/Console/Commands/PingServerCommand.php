<?php

namespace App\Console\Commands;

use App\Jobs\PingServer;
use App\Models\Server;
use Illuminate\Console\Command;

class PingServerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'server:ping';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ping server list';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $servers = Server::all();
        foreach ($servers as $server) {
            if (!$server->deleted) {
                PingServer::dispatch($server->id);
            }
        }
    }
}
