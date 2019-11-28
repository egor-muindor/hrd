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
                                <h2 class="text-center">Добавить соискателя</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('invites.store') }}" method="post">
                            @csrf
                            <p class="text-info">На электронную почту соискателя будет отправлено письмо, со ссылкой на
                                регистрацию в системе</p>
                            <div class="form-group">
                                <label for="email" class="col-form-label">Введите электронную почту соискателя:</label>
                                <input id="email" class="form-control" name="email" type="email" placeholder="Email">
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Отправить приглашение</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

