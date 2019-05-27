@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-10">
            @include('layouts.message_block')
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <h2>Панель управления руководителя</h2>
                        <a class="btn btn-primary" href="{{ route('candidate.create') }}">Добавить нового кандидата</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection