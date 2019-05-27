@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <h2>Панель управления руководителя</h2>
                        <hr>
                        <h3>Управление кандидатами</h3>

                        <div class="form-group">
                            <a class="btn btn-outline-primary" href="{{ route('candidate.create') }}">Добавить нового кандидата</a>
                            <a class="btn btn-outline-primary" href="{{ route('candidate.index') }}">Список кандидатов</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection