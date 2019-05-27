@extends('layouts.app')

@section('content')
    @push ('sctipts')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    @endpush
    <div class="row justify-content-center align-items-start">

        <div class="col-md-10">
            <div class="container">
                @include('ap_old.layouts.message_blog')
                <div id="success" class="sticky-top" style="padding-top: 10px"></div>

                <nav class="nav navbar">
                    <a class="btn btn-info" href="{{ route('application.index') }}">Назад</a>

                    <a class="btn btn-outline-primary" href="{{ route('application.edit', $application->id) }}">Редактировать</a>
                </nav>
                <div class="row justify-content-center">
                    <div class="col-md-9">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        @php /** @var \App\Models\Application $application */ @endphp
                                        <div class="tab-content">

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

                                                    <label class="col-form-label">Серия и номер паспорта</label>
                                                    <input class="form-control" readonly value="{{ $application->passport_id }}">
                                                    <label class="col-form-label">СНИЛС</label>
                                                    <input class="form-control" readonly value="{{ $application->snils }}">
                                                    <label class="col-form-label">ИНН</label>
                                                    <input class="form-control" readonly value="{{ $application->inn }}">

                                                    <label class="col-form-label">Предыдущие места работу (трудовая книжка)</label>
                                                    <textarea class="form-control" readonly>{{ $application->employment_history }}</textarea>
                                                    <label class="col-form-label">Научные работы</label>
                                                    <textarea class="form-control" readonly>{{ $application->scientific_works }}</textarea>

                                                    <label class="col-form-label">Email</label>
                                                    <input class="form-control" readonly value="{{ $application->email }}">
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
                    <div class="col-md-3">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <div class="col-md">
                                                @if($application->status == 0)
                                                    <a class="btn btn-primary" id="sub_app" onclick="ajaxReq(1)">Принять</a>
                                                    <a class="btn btn-danger" id="deny_app" onclick="ajaxReq(2)">Отклонить</a>
                                                @endif
                                            </div>
                                            <label class="col-form-label">Статус заявки</label>
                                            <input id="status" class="form-control" readonly value="@switch($application->status)
                                                @case(0)Не проверена@break
                                                @case(1)Принята@break
                                                @case(2)Отклонена@break
                                                @default Не найден статус
                                                @endswitch">
                                            <label class="col-form-label">Дата создания: </label>
                                            <input class="form-control" disabled value="{{ $application->created_at }}">
                                            <label class="col-form-label">Дата изменения: </label>
                                            <input id="update_time" class="form-control" disabled value="{{ $application->updated_at }}">
                                            @if(!empty($application->deleted_at))
                                                <label class="col-form-label">Дата удаления: </label>
                                                <input class="form-control" disabled value="{{ $application->deleted_at }}">
                                            @endif

                                            @if($application->status == 1)
                                                <div class="align-items-center">
                                                    <div class="col-md">
                                                        <br>
                                                        <a class="form-control btn btn-warning" id="export_app" onclick="exportTo1C()">Отправить в 1С</a>
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
        </div>
    </div>

    <script>
        function ajaxReq(value){
            $('#sub_app').hide();
            $('#deny_app').hide();
            $.ajax({
                type:'POST',
                url:'{{ route('application.submit.status') }}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:'id={{$application->id}}&status='+value,
                success:function(resp){

                    $('#status').val(resp.status);
                    $('#update_time').val(resp.updated);
                    $('#success').append(
                        `<div class="row justify-content-center">
                            <div class="col-md-11">
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">x</span>
                                    </button>
                                    ${resp.success}
                                </div>
                            </div>
                        </div>`)
                }
            });

        }

        function exportTo1C(){
            $('#export_app').hide();
            $.ajax({
                type:'POST',
                url:'{{ route('application.export') }}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:'id={{$application->id}}',
                success:function(resp) {
                    if (resp.code == 200) {
                    $('#success').append(
                        `<div class="row justify-content-center">
                            <div class="col-md-11">
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">x</span>
                                    </button>
                                    ${resp.message}
                                </div>
                            </div>
                        </div>`)
                    } else {
                        $('#success').append(
                            `<div class="row justify-content-center">
                                <div class="col-md-11">
                                    <div class="alert alert-danger" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">x</span>
                                        </button>
                                        ${resp.message}
                                    </div>
                                </div>
                            </div>`)
                        $('#export_app').show();
                    }
                }
            });

        }
    </script>

@endsection