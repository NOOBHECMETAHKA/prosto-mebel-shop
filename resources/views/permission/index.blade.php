@extends('layouts.adminApp')

@section('content')
    <div class="container">
        <div class="w-100 d-flex flex-column align-items-center">
            <h1 class="text-center">Пользователи</h1>
            <div class="w-75">
                <table class="table">
                    <thead>
                    <th>Электронная почта</th>
                    <th colspan="2">Роль</th>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <td>
                            {{ $user->email }}
                        </td>
                        <td>
                            {{ $roles[$user->role] }}
                        </td>
                        <td>
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal-{{ $user->id }}">
                                Изменить
                            </button>
                            <div class="modal fade" id="exampleModal-{{ $user->id }}" tabindex="-1"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="" method="post">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Окно изменения</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Пользователь: {{ $user->email }}</p>
                                                <label class="form-check-label"
                                                       for="role">Роль</label>
                                                <select name="role" id="role" class="form-select" aria-label="">
                                                    @foreach($roles as $key => $role)
                                                        <option value="{{ $key }}"
                                                                @if($user->role == $key) selected @endif>{{ $role }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Закрыть
                                                </button>
                                                <button type="button" class="btn btn-warning">Сохранить</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </td>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
