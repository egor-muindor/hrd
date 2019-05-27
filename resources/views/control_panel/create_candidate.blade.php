@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-10">
            @include('layouts.message_block')
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <h2>Добавить кандидата</h2>
                        <hr>
                        <form action="{{ route('candidate.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="email" class="col-form-label">Введите электронную почту кандидата:</label>
                                <input id="email" class="form-control" name="email" type="text" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-form-label">Введите пароль:</label>
                                <input id="password" class="form-control" name="password" type="text" placeholder="Пароль">
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Создать</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

