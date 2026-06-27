@extends('layouts.app')
@section('title', $sekdin['name'] . ' - Sekdin')

@section('styles')
<style>
    .sekdin-detail-hero {
        background: #071739;
        color: white;
        border-radius: 24px;
        padding: 40px;
        position: relative;
        overflow: hidden;
    }
    .sekdin-detail-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image: url('{{ $sekdin['background'] }}');
        background-repeat: no-repeat;
        background-position: right center;
        background-size: 260px;
        opacity: 0.08;
        filter: blur(2px) grayscale(1);
        pointer-events: none;
    }
    .sekdin-detail-hero > div {
        position: relative;
        z-index: 1;
    }
    .sekdin-detail-hero img {
        width: 100px;
        height: 100px;
        object-fit: contain;
        background: white;
        border-radius: 20px;
        padding: 12px;
    }
    .sekdin-detail-section {
        margin-top: 40px;
    }
    .sekdin-detail-card {
        border-radius: 24px;
        box-shadow: 0 20px 60px rgba(7,23,57,.08);
        border: none;
    }
    .sekdin-detail-card h5 {
        color: #071739;
    }
    .list-feature {
        list-style: none;
        padding-left: 0;
    }
    .list-feature li {
        margin-bottom: 0.85rem;
    }
    .list-feature li::before {
        content: '✔';
        color: #f5b93b;
        margin-right: 0.75rem;
    }
</style>
@endsection

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="sekdin-detail-hero mb-5">
                <div class="d-flex flex-column flex-md-row align-items-center gap-4">
                    <div>
                        <img src="{{ $sekdin['logo'] }}" alt="Logo {{ $sekdin['name'] }}" style="width:100px; height:100px; object-fit:contain; background:white; border-radius:20px; padding:12px;">
                    </div>
                    <div class="text-center text-md-start">
                        <h1 class="fw-bold mb-2">{{ $sekdin['name'] }}</h1>
                        <p class="mb-1">{{ $sekdin['ministry'] }}</p>
                        <p class="mb-0">Lokasi: {{ $sekdin['location'] }}</p>
                    </div>
                </div>
            </div>

            <div class="card sekdin-detail-card p-4 sekdin-detail-section">
                <div class="card-body">
                    <h4 class="fw-bold mb-3">Tentang {{ $sekdin['name'] }}</h4>
                    <p class="mb-4">{{ $sekdin['description'] }}</p>

                    <div class="row gy-4">
                        <div class="col-md-6">
                            <div class="p-4" style="background:#f7f8fb; border-radius:18px;">
                                <h5 class="fw-bold">Lokasi Sekdin</h5>
                                <p class="mb-0">{{ $sekdin['location'] }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-4" style="background:#f7f8fb; border-radius:18px;">
                                <h5 class="fw-bold">Instansi</h5>
                                <p class="mb-0">{{ $sekdin['ministry'] }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row gy-4 sekdin-detail-section">
                        <div class="col-md-6">
                            <div class="p-4" style="background:#fff8e7; border-radius:18px; border:1px solid #f5e0a8;">
                                <h5 class="fw-bold">Persyaratan</h5>
                                <ul class="list-feature mt-3">
                                    @foreach($sekdin['requirements'] as $requirement)
                                        <li>{{ $requirement }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-4" style="background:#eef9ff; border-radius:18px; border:1px solid #cfe9ff;">
                                <h5 class="fw-bold">Ketentuan</h5>
                                <ul class="list-feature mt-3">
                                    @foreach($sekdin['terms'] as $term)
                                        <li>{{ $term }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="sekdin-detail-section">
                        <h5 class="fw-bold mb-3">Urutan Seleksi</h5>
                        <ol class="ps-3">
                            @foreach($sekdin['selection'] as $step)
                                <li class="mb-2">{{ $step }}</li>
                            @endforeach
                        </ol>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
