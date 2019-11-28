@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('layouts.message_block')
                <div class="card">
                    <div class="card-header">{{ __('Регистрация') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('registration.registration') }}">
                            @csrf
                            <input hidden value="{{ $invite->token }}" name="token">

                            <div class="form-group row">
                                <label
                                    for="email"
                                    class="col-md-4 col-form-label text-md-right"
                                >{{ __('E-Mail адрес') }}</label>

                                <div class="col-md-6">
                                    <input
                                        id="email" type="email"
                                        class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                        name="email" readonly value="{{$invite->email}}"
                                    >

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

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
                            <div class="form-group row text-center justify-content-center">
                                <div class="col-md-8 form-check">
                                    <input
                                        class="form-check-input" id="rules" name="rules" required
                                        type="checkbox"
                                    >
                                    <label class="form-check-label text-wrap" for="rules">Я ознакомился с
                                        <a href="#" class="editor-link">политикой конфиденциальности </a>и принимаю их
                                        условия.
                                    </label>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Зарегистрировать') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
