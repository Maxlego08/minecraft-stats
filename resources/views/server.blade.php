@extends('layouts.app')

@section('title', $server->name)
@section('description', 'Statistiques du serveur ' . $server->name)

@section('content')

    <div class="stats">

        <div class="stats-header">
            <div class="container stats-header-content">
                <div class="header-name">
                    <span class="header-name-name"><a href="{{ route('server', ['name' => Str::slug($server->name), 'server' => $server]) }}">{{ $server->name }}</a></span>
                    <span class="header-name-ip">{{ $server->ip }}</span>
                </div>
                <div class="header-online">
                    <div class="header-online-top">
                        <span class="server-status" type="{{ $server->is_online ? "up" : "down" }}"></span>
                        <span class="server-ip-online">{{ $server->currentOnline() }}/{{ $server->max_players }}</span>
                    </div>
                    <div class="header-online-bottom">
                        <span>Record: {{ $server->online_record_players }} ({{ format_date($server->online_record_players_at, true) }})</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div>
                <!--<canvas id="stats" data-url="{{ route('stats.days', $server) }}"></canvas>-->
                <div id="stats" data-url="{{ route('stats.days', $server) }}"></div>
            </div>
        </div>
    </div>

@endsection

@push('footer-scripts')
    @vite(['resources/js/stats.js'])
@endpush
