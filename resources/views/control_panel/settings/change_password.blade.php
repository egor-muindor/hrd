@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-4">
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
                                <h2 class="text-center">Изменить пароль</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('user.update.password') }}" method="post">
                            @csrf
                            <div class="form-group row">
                                <label
                                    for="password"
                                    class="col-md-4 col-form-label text-md-right"
                                >{{ __('Пароль') }}</label>

                                <div class="col-md-6">
                                    <input
                                        id="password" type="password"
                                        class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                        name="password" required
                                    >

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label
                                    for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right"
                                >{{ __('Подтвердите пароль') }}</label>

                                <div class="col-md-6">
                                    <input
                                        id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required
                                    >
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Обновить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

