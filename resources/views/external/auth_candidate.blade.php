@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Авторизация кандидата') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('registration.authorization') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email">Почта:</label>
                                <input required type="text" name="email" id="email" class="form-control" value="{{old('email')}}">
                            </div>
                            <div class="form-group">
                                <label for="password">Пароль:</label>
                                <input required type="password" name="password" id="password" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary">Авторизоваться</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
