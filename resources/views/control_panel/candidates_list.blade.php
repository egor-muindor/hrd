@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-secondary" href="{{ route('head.index') }}">Назад</a>
                        <div class="col text-center">
                            <h2>Список зарегистрированных соискателей</h2>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-responsive-sm">
                            <thead>
                            <th>#</th>
                            <th>Email</th>
                            <th>Статус заявления</th>
                            <th>Имя регистратора</th>
                            </thead>
                            <tbody>
                            @foreach($candidates as $candidate)
                            <tr>
                                <td>{{ $candidate->id }}</td>
                                <td>{{ $candidate->email }}</td>
                                <td>{{ $candidate->status }}</td>
                                <td>{{ $candidate->head_name }}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($candidates->total() > $candidates->count())
        <br>
        <div class="row justify-content-center">
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        {{ $candidates->links() }}
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection

