@php use Illuminate\Support\Str; @endphp
@extends('layouts.app')

@section('title', 'Serveurs')
@section('description', 'Liste des serveurs')

@section('content')

    <div class="servers container">
        @foreach($servers as $server)
            <a class="server" id="server-{{ $server->id }}"
               href="{{ route('server', ['name' => Str::slug($server->name), 'server' => $server]) }}">
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
            </a>
        @endforeach
    </div>

@endsection
