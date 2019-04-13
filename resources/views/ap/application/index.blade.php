@extends('layouts.app')

@section('content')
    
    
    <div class="row justify-content-center  align-items-start">

        <div class="col-md-10">
            <div class="row justify-content-center">
                    <div class="col-md">
                        @include('ap.layouts.message_blog')
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-hover table-responsive-md">
                                    <thead class="bg-white sticky-top">
                                    <tr class="row">
                                        <th class="col-md-1">#</th>
                                        <th class="col-md">Фамилия</th>
                                        <th class="col-md">Имя</th>
                                        <th class="col-md">Отчество</th>
                                        <th class="col-md">Статус заявки</th>
                                        <th class="col d-none d-lg-block d-xl-block">Дата подачи</th>
                                        <th class="col d-none d-lg-block d-xl-block">Дата обновления заявки</th>
                                        <th class="col-md"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($paginator as $item)
                                        @php /** @var Application $item */use App\Models\Application; @endphp
                                        <tr class="row">
                                            <td class="col-md-1">{{ $item->id }}</td>
                                            <td class="col-md">{{ $item->last_name }}</td>
                                            <td class="col-md">{{ $item->first_name }}</td>
                                            <td class="col-md">{{ $item->middle_name }}</td>
                                            <td class="col-md">@switch($item->status)
                                                    @case(0)Не проверена@break
                                                    @case(1)Принята@break
                                                    @case(2)Отклонена@break
                                                    @default Неизвестный статус@break
                                                @endswitch</td>
                                            <td class="col d-none d-lg-block d-xl-block">{{ $item->created_at }}</td>
                                            <td class="col d-none d-lg-block d-xl-block">{{ $item->updated_at }}</td>
                                            <td class="col-md"><a href="{{ route('application.show', $item->id) }}" class="btn btn-group">Подробнее</a>                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            </div>
            @if($paginator->total() > $paginator->count())
                <br>
                <div class="row justify-content-center">
                    <div class="col-md-6">
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