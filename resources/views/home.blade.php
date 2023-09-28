@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body text-bg-danger">
                    <h5 class="card-title">Сайт на доработке</h5>
                    <p class="card-text">Мне лень верстать главную страницу</p>
                </div>
            </div>
        </div>
        <div id="carouselExample" class="carousel slide w-50">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('storage\images\ASvZ5RKIc7DYUKBDpnjdsppF35z35AtTMCk5FBtg.png') }}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('storage\images\BlHSTjkvSK3iwV0rAE6XlExB0hzdAjBHqXlAiaUd.png') }}" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</div>
@endsection
