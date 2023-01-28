<?php

namespace App\Http\Controllers;

use App\Models\Server;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServerController extends Controller
{
    /**
     * Show server information
     *
     * @param string $name
     * @param Server $server
     * @return Factory|View|Application
     */
    public function index(string $name, Server $server): Factory|View|Application
    {
        return view('server', [
            'server' => $server,
        ]);
    }
}
