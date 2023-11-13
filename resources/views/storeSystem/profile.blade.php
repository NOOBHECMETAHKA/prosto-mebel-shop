@extends('layouts.defaultApp')

@section('content')
    <div class="modal fade" id="addAddress" tabindex="-1" aria-labelledby="addAddress" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('profile.address.store') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Добавление адреса</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                    </div>
                    <div class="modal-body">
                        <div class=" row g-3">
                            <div class="col-md-6">
                                <input name="City" type="text" class="form-control" aria-label="" placeholder="Город">
                            </div>
                            <div class="col-md-6">
                                <input name="Street" type="text" class="form-control" aria-label="" placeholder="Улица">
                            </div>
                            <div class="col-md-4">
                                <input name="House" type="text" class="form-control" aria-label="" placeholder="Дом">
                            </div>
                            <div class="col-md-4">
                                <input name="Entrance" type="text" class="form-control" aria-label=""
                                       placeholder="Подъезд">
                            </div>
                            <div class="col-md-4">
                                <input name="Apartment" type="text" class="form-control" aria-label=""
                                       placeholder="Квартиры">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-success">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div>
        <h2 class="text-center">Профиль</h2>
        @error('City')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Ошибка добавления! </strong><span>{{ $message }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert"
                    aria-label="Close"></button>
        </div>
        @enderror
        @error('Street')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Ошибка добавления! </strong><span>{{ $message }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert"
                    aria-label="Close"></button>
        </div>
        @enderror
        @error('House')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Ошибка добавления! </strong><span>{{ $message }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert"
                    aria-label="Close"></button>
        </div>
        @enderror
        @error('Entrance')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Ошибка добавления! </strong><span>{{ $message }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert"
                    aria-label="Close"></button>
        </div>
        @enderror
        @error('Apartment')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Ошибка добавления! </strong><span>{{ $message }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert"
                    aria-label="Close"></button>
        </div>
        @enderror
        <div class="card w-50">
            <div class="card-body">
                <div class="card-title text-secondary">
                    <h5><span class="text-primary fw-bolder">#</span> Как к вам обращаться?</h5>
                </div>
                <form action="{{ route('home.profile.rename') }}" method="post">
                    <div class="input-group mb-3">
                        @csrf
                        <input name="name" class="form-control" placeholder="Имя пользователя" id="findButton"
                               aria-label="Как к вам обращатся?" type="text" value="{{ $user->name }}"/>
                        <button class="btn btn-warning" type="submit">Изменить</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card w-75 mt-3">
            <div class="card-body">
                <div class="card-title">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="text-secondary"><span class="text-primary fw-bolder">#</span> Ваши адреса</h5>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#addAddress">
                            Добавить
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    @if(count($addresses) != 0)
                        <table class="table">
                            <thead>
                            <th>#</th>
                            <th>Адресс</th>
                            <th colspan="2"></th>
                            </thead>
                            <tbody>
                            @foreach($addresses as $key => $address)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ \App\Models\Address::show($address) }}</td>
                                    <td>
                                        <a href="{{ route('profile.address.edit', ['id' => $address->id]) }}" class="btn btn-warning">Изменить</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('profile.address.delete', ['id' => $address->id]) }}"
                                              method="post">
                                            @csrf
                                            <button class="btn btn-danger" type="submit">Удалить</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-danger" role="alert">
                            На данном профиле отсуствуют адреса! Требуется добавить хотя бы один для получения возможности создатьвать заказ!
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="mt-3">
        <div class="card w-50">
            <div class="card-body">
                <div class="card-title">
                    <h5 class="text-secondary"><span class="text-primary fw-bolder">#</span> Ваши заказы</h5>
                </div>
            </div>
        </div>
    </div>
@endsection
