@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <h3>Главное меню</h3>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            @guest
                                <a class="btn btn-outline-primary mb-2" href="{{route('login')}}">Авторизация
                                    сотрудника</a>
                                <hr>
                            @else
                                <a class="btn btn-outline-primary mb-2" href="{{route('head.index')}}">Панель управления сотрудника</a>
                                <hr>
                            @endguest
                            <a class="btn btn-outline-primary mb-2" href="{{route('registration.lk')}}">Личный кабинет кандидата</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

