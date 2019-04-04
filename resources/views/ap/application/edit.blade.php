@extends('layouts.app')
@push ('sctipts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="{{ asset('js/jquery.mask.min.js') }}"></script>
@endpush

@section('content')

    <div class="row justify-content-center align-items-start">
        @include('ap.layouts.left_col_menu')
        <div class="col-md-10">
            <div class="container">
                <div id="success"></div>
                @include('ap.layouts.message_blog')
                <form method="post" action="{{ route('application.update', $application->id) }}" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                <nav class="nav navbar">
                    <div>
                        <a class="btn btn-secondary" href="{{ route('application.show', $application->id) }}">Назад к просмотру</a>
                    </div>
                    <button class="btn btn-primary" href="{{ route('application.edit', $application->id) }}" type="submit">Сохранить</button>
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
                                                    <label class="col-form-label" for="last_name">Фамилия</label>
                                                    <input class="form-control " name="last_name" minlength="2" required placeholder="Фамилию" value="{{ old('first_name', $application->last_name) }}">
                                                    <label class="col-form-label" for="first_name" >Имя</label>
                                                    <input class="form-control " name="first_name" minlength="2" required placeholder="Имя" value="{{ old('first_name', $application->first_name) }}">
                                                    <label class="col-form-label" for="middle_name">Отчество</label>
                                                    <input class="form-control " name="middle_name" minlength="2" required placeholder="Отчество" value="{{ old('middle_name', $application->middle_name) }}">

                                                    <label class="col-form-label">Отдел</label>
                                                    <input class="form-control" readonly
                                                           value="{{ $application->post->departament->name }}">
                                                    <label class="col-form-label">Должность</label>
                                                    <input class="form-control" readonly value="{{ $application->post->name }}">

                                                    <label class="col-form-label" for="passport_id">Серия и номер паспорта</label>
                                                    <input id="pass_id" pattern="(^\d{4} \d{6}$)" class="form-control" name="passport_id" required
                                                           placeholder="Например 1234 123456" type="text" value="{{ old('passport_id', $application->passport_id) }}">
                                                    <label class="col-form-label" for="snils">СНИЛС</label>
                                                    <input id="snils_id" pattern="(^\d{3}-\d{3}-\d{3}-\d{2}$)" class="form-control" name="snils" required
                                                           placeholder="Например 123-456-789-12" value="{{ old('snils', $application->snils) }}">
                                                    <label class="col-form-label" for="inn">ИНН</label>
                                                    <input id="inn_id" pattern="\d{12}" class="form-control" name="inn" required
                                                           placeholder="ИНН" value="{{ old('inn',$application->inn) }}">
                                                    <label class="col-form-label" for="employment_history">Трудовая история</label>
                                                    <textarea class="form-control" name="employment_history" minlength="10"
                                                              required placeholder="Введите предыдущие места работы"
                                                              value="">{{ old('employment_history', $application->employment_history) }}</textarea>
                                                    <label class="col-form-label" for="scientific_works">Научные труды</label>
                                                    <textarea class="form-control" name="scientific_works"  minlength="10"
                                                              required placeholder="Введите ваши научные работы"
                                                              value="">{{ old('scientific_works', $application->scientific_works) }}</textarea>


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

                                            <div class="col-md">
                                                @if($application->status != 0)
                                                    <a class="btn btn-outline-warning col-md"  style="white-space: pre-wrap" id="reset_app" onclick="ajaxReq(0)">Вернуть на рассмотрение</a>
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
                                            <input class="form-control" id="update_time" disabled value="{{ $application->updated_at }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function ajaxReq(value){
            $.ajax({
                type:'POST',
                url:'{{ route('application.submit.status') }}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:'id={{$application->id}}&status='+value,
                success:function(resp){
                    $('#reset_app').hide();
                    $('#status').val(resp.status);
                    $('#update_time').val(resp.updated);
                    $('#success').html(`<div class="row justify-content-center">
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
    </script>
@endsection