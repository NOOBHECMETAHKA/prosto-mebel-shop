@extends('layouts.defaultApp')

@section('content')
    <div class="d-flex flex-column align-items-center">
        <h3 class="text-center">Добавление адреса</h3>
        <div class="card w-75">
            <div class="card-body">
                <form action="{{ route('profile.address.store') }}" method="post" class=" row g-3">
                    @error('City')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Ошибка! </strong><span>{{ $message }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                    </div>
                    @enderror
                    @error('Street')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Ошибка! </strong><span>{{ $message }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                    </div>
                    @enderror
                    @error('House')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Ошибка! </strong><span>{{ $message }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                    </div>
                    @enderror
                    @error('Entrance')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Ошибка! </strong><span>{{ $message }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                    </div>
                    @enderror
                    @error('Apartment')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Ошибка! </strong><span>{{ $message }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                    </div>
                    @enderror
                    @csrf
                    <div class="col-md-6">
                        <input name="City" type="text" class="form-control" aria-label="" placeholder="Город">
                    </div>
                    <div class="col-md-6">
                        <input name="Street" type="text" class="form-control" aria-label="" placeholder="Улица">
                    </div>
                    <div class="col-md-2">
                        <input name="House" type="text" class="form-control" aria-label="" placeholder="Дом">
                    </div>
                    <div class="col-md-2">
                        <input name="Entrance" type="text" class="form-control" aria-label="" placeholder="Подъезд">
                    </div>
                    <div class="col-md-2">
                        <input name="Apartment" type="text" class="form-control" aria-label="" placeholder="Номер квартиры">
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-success" type="submit">Добавить!</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
