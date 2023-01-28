@extends('layouts.app')

@section('title', 'Servers')

@section('content')

    <div class="servers">
        @foreach($servers as $server)
            <div class="server" id="server-{{ $server->id }}">
                <div class="server-icon">
                    <img src="{{ $server->getIcon() }}" height="50" width="50" alt="server icon">
                </div>
                <div class="server-description">
                    <div class="server-informations">
                        <span class="server-informations-name">{{ $server->name }}</span>
                        <span class="server-informations-ip">{{ $server->ip }}</span>
                    </div>
                    <div class="server-ip">
                        <span class="server-status" type="{{ $server->is_online ? "up" : "down" }}"></span>
                        <span class="server-ip-online">{{ $server->currentOnline() }}/{{ $server->max_players }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection
