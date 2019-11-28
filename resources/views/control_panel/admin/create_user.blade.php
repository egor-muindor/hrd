@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            @include('layouts.message_block')
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-1">
                                <a
                                    role="button" tabindex="0" class="btn btn-secondary"
                                    href="{{ route('head.index') }}"
                                >Назад</a>
                            </div>
                            <div class="col">
                                <h2 class="text-center">Добавить сотрудника</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <form action="{{ route('admin.user.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="email" class="col-form-label">Электронная почта:</label>
                                <input
                                    id="email" class="form-control" name="email" type="email"
                                    placeholder="contact@mospolytech.ru"
                                >
                                <a class="text-secondary">Электронная почта — используется для авторизации в системе</a>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-form-label">ФИО сотрудника:</label>
                                <input
                                    id="email" class="form-control" name="name" type="text"
                                    placeholder="Иванов Иван Иванович"
                                >
                                <a class="text-secondary">ФИО — отображается в профиле и в отправленных заявках</a>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-form-label">Пароль:</label>
                                <input
                                    id="password" class="form-control" name="password" type="text"
                                    placeholder="Пароль" minlength="8" value="{{ Str::random(16) }}"
                                >
                                <a class="text-secondary">Пароль должен быть длинной от 8 символов</a>
                            </div>
                            <div class="form-check">
                                <input
                                    class="form-check-input" id="admin" name="admin"
                                    type="checkbox"
                                >
                                <label class="form-check-label text-wrap" for="admin">Аккаунт администратора
                                </label>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Создать</button>
                            </div>
                            <a class="text-center text-info text-wrap">После создания аккаунта, на указанную почту
                                придет письмо с логином и сгенерированным паролем</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

