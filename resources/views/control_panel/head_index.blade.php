@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <h2>Панель управления</h2>
                        <hr>
                        <h4>Управление аккаунтами соискателей</h4>

                        <div class="form-group">
                            <a class="btn btn-outline-primary" href="{{ route('invites.create') }}">Добавить нового соискателя</a>
                            <a class="btn btn-outline-primary" href="{{ route('candidate.index') }}">Список соискателей</a>
                            <a class="btn btn-outline-primary" href="{{ route('invites.index') }}">Список приглашений</a>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection