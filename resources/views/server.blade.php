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
                <canvas id="stats" data-url="{{ route('stats.days', $server) }}"></canvas>
            </div>
        </div>
    </div>

@endsection

@push('footer-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.2.0/chart.min.js"
            integrity="sha512-qKyIokLnyh6oSnWsc5h21uwMAQtljqMZZT17CIMXuCQNIfFSFF4tJdMOaJHL9fQdJUANid6OB6DRR0zdHrbWAw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @vite(['resources/js/stats.js'])
@endpush