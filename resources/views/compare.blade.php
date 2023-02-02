@extends('layouts.app')

@section('title', 'Serveurs')
@section('description', 'Comparaisons des serveurs')

@section('content')

    <div class="stats">
        <div class="container">
            <div class="card">
                <span class="card-title">Comparaison des serveurs ({{ $online }} joueurs en ligne)</span>
                <div class="global-stats" id="stats" data-url="{{ route('compares') }}">
                    <div id="stats-loader" class="card-stats-loader">
                        <div class="lds-ripple">
                            <div></div>
                            <div></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('footer-scripts')
    @vite(['resources/js/compare.js'])
@endpush
