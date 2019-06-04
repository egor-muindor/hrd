@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col text-left">
                                <h2>Панель управления</h2>
                            </div>
                            @if($user->isAdmin())
                                <div class="col text-right">
                                    <strong><a class="text-info">Администратор</a></strong>
                                </div>
                            @endif
                        </div>
                        Вы авторизованы как: <strong><a class="text-info">{{ $user->name }}</a></strong>
                    </div>
                    <div class="card-body">
                        <h4>Управление аккаунтами соискателей</h4>

                        <div class="form-group">
                            <a class="btn btn-outline-primary" href="{{ route('invites.create') }}">Добавить нового
                                соискателя</a>
                            <a class="btn btn-outline-primary" href="{{ route('candidate.index') }}">Список
                                соискателей</a>
                            <a class="btn btn-outline-primary" href="{{ route('invites.index') }}">Список
                                приглашений</a>
                        </div>
                        <hr>
                        @if($user->isAdmin())
                            <h4>Управление аккаунтами сотрудников</h4>
                            <div class="form-group">
                                <a class="btn btn-outline-primary" href="{{ route('admin.user.create') }}">Добавить нового
                                    сотрудника</a>
                                <a class="btn btn-outline-primary" href="{{ route('admin.user.index') }}">Список
                                    сотрудников</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection