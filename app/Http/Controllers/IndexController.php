<?php

namespace App\Http\Controllers;

use App\Models\Server;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class IndexController extends Controller
{
    /**
     * Display index page
     *
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        return view('index', [
            'servers' => Server::all(),
        ]);
    }
}
