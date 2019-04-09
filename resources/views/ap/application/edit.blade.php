@extends('layouts.app')
@push ('sctipts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="{{ asset('js/jquery.mask.min.js') }}"></script>
@endpush

@section('content')

    <div class="row justify-content-center align-items-start">

        <div class="col-md-10">
            <div class="container">
                <div id="success" class="sticky-top" style="padding-top: 10px"></div>
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
                                                    <select onchange="changePosts(this.value)" id="departament_id" name="departament_id"
                                                            class="form-control" placeholder="Выберете отдел">
                                                            @foreach($departaments as $departament)
                                                                <option @if($application->post->departament_id === $departament->id) selected @endif value="{{ $departament->id }}">{{ $departament->name }}</option>
                                                            @endforeach
                                                    </select>
                                                    <label class="col-form-label">Должность</label>
                                                    <select id="post_id" name="post_id"
                                                            class="form-control" required placeholder="Выберете вакансию">
                                                        @php /** @var \App\Models\Posts $post */ @endphp
                                                        @foreach($posts as $post)
                                                            <option @if($application->post_id === $post->id) selected @endif value="{{ $post->id }}">{{ $post->name }}</option>
                                                        @endforeach
                                                    </select>


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
                                                    <label class="col-form-label" for="email">Email</label>
                                                    <input id="email" type="email" class="form-control" name="email" required
                                                           placeholder="Email" value="{{ old('email',$application->email) }}">
                                                    @if(count($addictions)>0)
                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <h2 class="card-title" id="addictions_body">Приложения</h2>
                                                                @php /** @var \App\Models\Addiction $addiction */ @endphp
                                                                <table id="table_addiction" class="table table-hover">
                                                                    <thead>
                                                                    <th class="col-md-10">Описание</th>
                                                                    <th class="col-md">Ссылка</th>
                                                                    </thead>
                                                                    <tbody id="addictions_body">
                                                                    @foreach($addictions as $addiction)
                                                                        <tr id="addiction_id_{{ $addiction->id }}">
                                                                            <td>{{$addiction->description}}</td>
                                                                            <td>

                                                                                    <a class="btn btn-group" href="{{ \Illuminate\Support\Facades\Storage::url($addiction->file) }}">Открыть</a>
                                                                                    <a type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#delete_addiction" data-addiction="{{ $addiction->id }}"  >Удалить</a>

                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_addiction">Добавить новое приложение</button>
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
                                            <div class="col-md">
                                                <br>
                                                <a class="btn btn-danger col-md"  style="white-space: pre-wrap" id="delete_app" data-toggle="modal" data-target="#myModal" onclick="">Удалить заявку</a>
                                            </div>
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


{{--     Модальное окно удаления заявки --}}
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Вы хотите удалить заявку №{{ $application->id }}?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('application.destroy', $application->id) }}" method="post">
                    @method('DELETE')
                    @csrf
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
{{--    Модальное окно удаления приложения к заявке --}}
    <div class="modal fade" id="delete_addiction" tabindex="-1" role="dialog" aria-labelledby="myDeleteAddictionLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Вы действительно хотите удалить приложение?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn_delete_addiction" data-appid="{{ $application->id }}" data-addid="">Удалить</button>
                </div>
            </div>
        </div>
    </div>
{{--    Модальное окно добавления нового приложения к заявке --}}
    <div class="modal fade" id="add_addiction" tabindex="-1" role="dialog" aria-labelledby="AddNewAddiction" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="add_addiction_form" action="#add_addiction">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Добавление нового приложения</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input accept="image/*" type="file" required class="form-control-file" id="file_addiction">
                        <br>
                        <input type="text" required class="form-control" placeholder="Описание файла" id="description_addiction">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary" data-dismiss="modal" id="btn_upload_addiction" data-appid="{{ $application->id }}">Загрузить</button>
                </div>
            </div>
            </form>
        </div>
    </div>
    <script>


        $(document).ready(function($){
            $('#pass_id').mask('0000 000000');
            $('#snils_id').mask('000-000-000-00');
            $('#inn_id').mask('000000000000');

            $('#btn_delete_addiction').on('click' , function () {
                let addiction_id = this.dataset['addid'];
                let application_id = this.dataset['appid'];
                $.ajax({

                    type:'DELETE',
                    url:'{{route('addiction.destroy')}}',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:`addiction_id=${addiction_id}&application_id=${application_id}`,
                    success:function(resp){
                        show_message(resp.message, resp.code);
                        $('#addiction_id_'+addiction_id).remove()
                    }
                });
            });

            $('#btn_upload_addiction').on('click' , function (e) {
                let button = $(this);
                let application_id = button.data('appid');
                let description = $('#description_addiction').val();
                let file = $('#file_addiction').prop('files')[0];
                if (!((file) === undefined) && !((description) === '')) {


                    let data = new FormData();
                    data.append('file', file);
                    data.append('description', description);
                    data.append('application_id', application_id);
                    $.ajax({
                        type: 'POST',
                        cache: false,
                        contentType: false,
                        processData: false,
                        url: '{{route('addiction.store')}}',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: data,
                        success: function (resp) {
                            show_message(resp.message, resp.code);
                            if (resp.code == 200) {
                                $('#table_addiction tbody').append(
                                    `<tr id="addiction_id_${resp.addiction_id}">
                                        <td>${description}</td>
                                        <td>
                                            <a class="btn btn-group" href="${resp.url}">Открыть</a>
                                            <a type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#delete_addiction" data-addiction=${resp.addiction_id}"  >Удалить</a>
                                        </td>
                                    </tr>`);

                                $('#add_addiction_form').trigger('reset');
                            }
                        }
                    });
                }

            });


            $('#delete_addiction').on('show.bs.modal', function (event) {
                let button = $(event.relatedTarget); // Кнопка, что спровоцировало модальное окно

                let addiction_id = button.data('addiction'); // Извлечение информации из данных-* атрибутов
console.log(addiction_id);
                let modal = $(this);
                $(this).find('#btn_delete_addiction').attr('data-addid', addiction_id);
                modal.find('#del_addiction_id').val(addiction_id);

            });
        });

        function changePosts(val){
            $('#post_id').html('<option value="-1" selected disabled>Загрузка</option>');
            $.ajax({

                type:'POST',
                url:'{{route('ajax.getPostsByDepartament')}}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:'departament_id='+ val,
                success:function(resp){
                    insertIntoIndicatorSelector(resp['postList']);
                }
            })};
            function insertIntoIndicatorSelector(array){
                let result = '';
                for(let item of array){
                    result += `<option value="${item['id']}">${item['name']}</option>`
                }
                $('#post_id').html(result);
            }

        function ajaxReq(value){
            $('#reset_app').hide();
            $.ajax({
                type:'POST',
                url:'{{ route('application.submit.status') }}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:'id={{$application->id}}&status='+value,
                success:function(resp){
                    show_message(resp.success, 200)
                }
            });

        }
        function show_message(message, code){
            if (code === 200) {
                $('#success').append(
                    `<div class="row justify-content-center">
                            <div class="col-md-11">
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">x</span>
                                    </button>
                                    ${message}
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
                                        ${message}
                                    </div>
                                </div>
                            </div>`)
                $('#export_app').show();
            }

            // $('html, body').animate({ scrollTop: $('#app').offset().top }, 500);

        }
    </script>
@endsection