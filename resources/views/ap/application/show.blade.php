@extends('layouts.app')

@section('content')
    <div class="row justify-content-center align-items-start">
        @include('ap.layouts.left_col_menu')
        <div class="col-md-10">
            <div class="container">
                <nav class="nav navbar">
                    <a class="btn btn-primary" href="{{ route('application.index') }}">Назад</a>
                </nav>
                <div class="row justify-content-center">
                    <div class="col-md-9">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        @php /** @var \App\Models\Application $application */ @endphp
                                        <div class="tab-content">
                                            <div class="tab-pane active">
                                                <div class="form-group">
                                                    <label class="col-form-label">Ид записи</label>
                                                    <input class="form-control" readonly value="{{ $application->id }}">
                                                    <label class="col-form-label">ФИО</label>
                                                    <input class="form-control" readonly
                                                           value="{{ $application->last_name }} {{ $application->first_name }} {{ $application->middle_name }}">
                                                    <label class="col-form-label">Отдел</label>
                                                    <input class="form-control" readonly
                                                           value="{{ $application->post->departament->name }}">
                                                    <label class="col-form-label">Должность</label>
                                                    <input class="form-control" readonly value="{{ $application->post->name }}">
                                                    <label class="col-form-label">СНИЛС</label>
                                                    <input class="form-control" readonly value="{{ $application->snils }}">
                                                    <label class="col-form-label">ИНН</label>
                                                    <input class="form-control" readonly value="{{ $application->inn }}">
                                                    <label class="col-form-label">Статус</label>
                                                    <input class="form-control" readonly value="@switch($application->status)
                                                    @case(0)Не проверена@break
                                                    @case(1)Принята@break
                                                    @case(2)Отклонена@break
                                                    @default Не найден статус
                                                    @endswitch">
                                                    <label class="col-form-label">Предыдущие места работу (трудовая книжка)</label>
                                                    <textarea class="form-control" readonly>{{ $application->employment_history }}</textarea>
                                                    @if(count($addictions)>0)<div class="card-body">
                                                        <div class="form-group">
                                                            <h2 class="card-title">Приложения</h2>
                                                            @php /** @var \App\Models\Addiction $addiction */ @endphp
                                                            <table class="table table-hover">
                                                                <thead>
                                                                <th class="col-md-10">Описание</th>
                                                                <th class="col-md">Ссылка</th>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($addictions as $addiction)
                                                                    <tr>
                                                                        <td>{{$addiction->description}}</td>
                                                                        <td>
                                                                            <a class="btn btn-group" href="{{ \Illuminate\Support\Facades\Storage::url($addiction->file) }}">Открыть</a>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                        @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label class="col-form-label">Дата создания: </label>
                                            <input class="form-control" disabled value="{{ $application->created_at }}">
                                            <label class="col-form-label">Дата изменения: </label>
                                            <input class="form-control" disabled value="{{ $application->updated_at }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection