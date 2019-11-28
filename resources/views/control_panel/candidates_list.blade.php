@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-1">
                                <a
                                    role="button" tabindex="0" class="btn btn-secondary"
                                    href="{{ route('head.index') }}"
                                >Назад</a>
                            </div>
                            <div class="col-11">
                                <div class="col">
                                    <h2 class="text-center">Список зарегистрированных соискателей</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($candidates->count() == 0)
                            <h3 class="text-center">
                                Список соискателей пуст
                            </h3>
                        @else
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
                        @endif
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

