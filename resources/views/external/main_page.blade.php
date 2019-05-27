@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            @guest
                                <a class="btn btn-outline-primary" href="{{route('login')}}">Авторизация
                                    руководителя</a>
                                <hr>
                            @endguest
                            <a class="btn btn-outline-primary" href="{{route('registration.auth')}}">Авторизация кандидата</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

