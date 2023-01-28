@extends('layouts.app')

@section('title', $server->name)

@section('content')

    <div class="stats">

        <div class="stats-header">
            <div class="container stats-header-content">
                <div class="header-name">
                    <span class="header-name-name">{{ $server->name }}</span>
                    <span class="header-name-ip">{{ $server->ip }}</span>
                </div>
                <div class="header-online">
                    <span class="server-status" type="{{ $server->is_online ? "up" : "down" }}"></span>
                    <span class="server-ip-online">{{ $server->currentOnline() }}/{{ $server->max_players }}</span>
                </div>
            </div>
        </div>
        <div class="container">
            <div>

            </div>
        </div>
    </div>

@endsection
