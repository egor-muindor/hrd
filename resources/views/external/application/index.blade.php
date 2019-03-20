@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if(session('success'))
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">x</span>
                                </button>
                                {{ session()->get('success') }}
                            </div>
                        </div>
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Фамилия</th>
                                <th>Имя</th>
                                <th>Отчество</th>
                                <th>Статус заявки</th>
                                <th>Дата подачи</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($paginator as $item)
                                @php /** @var \App\Models\Application $item */ @endphp
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->last_name }}</td>
                                    <td>{{ $item->first_name }}</td>
                                    <td>{{ $item->middle_name }}</td>
                                    <td>@switch($item->status)
                                            @case(0)Не проверена@break
                                            @case(1)Принята@break
                                            @case(2)Отклонена@break
                                            @default Неизвестный статус@break
                                        @endswitch</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td><a href="#" class="btn btn-group">Подробнее</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @if($paginator->total() > $paginator->count())
                <br>
                <div class="row justify-content-center">
                    <div class="col-md">
                        <div class="card">
                            <div class="card-body">
                                {{ $paginator->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection