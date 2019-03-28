@extends('layouts.app')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <div class="col-md-12">
            <form method="post" action="{{ route('registration.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="container">
                    @php    /** @var \Illuminate\Support\ViewErrorBag $errors */ @endphp
                    @if($errors->any())
                        <div class="row justify-content-center">
                            <div class="col-md-11">
                                <div class="alert alert-danger" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">x</span>
                                    </button>

                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>

                                </div>
                            </div>
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="row justify-content-center">
                            <div class="col-md-11">
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">x</span>
                                    </button>
                                    {{ session()->get('success') }}
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="tab-content">
                                                <div class="tab-pane active">
                                                    <h2 class="text-center">Оформление заявки</h2>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-4">
                                                            <label class="col-form-label" for="last_name">Фамилия</label>
                                                            <input class="form-control " name="last_name" minlength="2" required placeholder="Фамилию" value="{{ old('first_name') }}">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label class="col-form-label" for="first_name" >Имя</label>
                                                            <input class="form-control " name="first_name" minlength="2" required placeholder="Имя" value="{{ old('first_name') }}">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label class="col-form-label" for="middle_name">Отчество</label>
                                                            <input class="form-control " name="middle_name" minlength="2" required placeholder="Отчество" value="{{ old('middle_name') }}">
                                                        </div>
                                                    </div>

                                                    <div class="form-row">
                                                        <div class="form-group col-md-4">
                                                            <label class="col-form-label" for="passport_id">Серия и номер паспорта</label>
                                                            <input class="form-control" name="passport_id" required
                                                                   placeholder="Например 1234 123456"  minlength="10" value="{{ old('passport_id') }}">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label class="col-form-label" for="snils">СНИЛС</label>
                                                            <input class="form-control" name="snils" required
                                                                   placeholder="Например 123-456-789-12"  minlength="14" value="{{ old('snils') }}">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label class="col-form-label" for="inn">ИНН</label>
                                                            <input class="form-control" name="inn"  minlength="12" required
                                                                   placeholder="ИНН" value="{{ old('inn') }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-form-label" for="employment_history">Трудовая история</label>
                                                        <textarea class="form-control" name="employment_history"  minlength="10"
                                                                  required placeholder="Введите предыдущие места работы"
                                                                  value="">{{ old('employment_history') }}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-form-label" for="edu_id">Документ об образовании, о присвоении ученой степени, о присвоении ученого звания.</label>
                                                        <input type="file" required multiple class="form-control-file" name="edu_id">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-form-label" for="medical_id">Медицинская книжка</label>
                                                        <input type="file" required multiple class="form-control-file" name="medical_id">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-form-label" for="criminal_record">Справка о наличии (отсутствии) судимости и (или) факта уголовного преследования либо о прекращении уголовного преследования по реабилитирующим основаниям.</label>
                                                        <input type="file" required multiple class="form-control-file" name="criminal_record">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-form-label" for="military_id">Военный билет</label>
                                                        <input type="file" multiple class="form-control-file" name="military_id">
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-form-label" for="scientific_works">Научные труды</label>
                                                        <textarea class="form-control" name="scientific_works"  minlength="10"
                                                                  required placeholder="Введите ваши научные работы"
                                                                  value="">{{ old('scientific_works') }}</textarea>
                                                    </div>


                                                    <div class="form-group">
                                                        <label class="col-form-label" for="departament_id">Отдел</label>
                                                        <select onchange="ajaxReq(this.value)" id="departament_id" name="departament_id"
                                                        class="form-control" placeholder="Выберете отдел">
                                                            @foreach($departaments as $departament)
                                                                <option @if(old('departament_id') === $departament->id) selected @endif value="{{ $departament->id }}">{{ $departament->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-form-label" for="post_id">Вакансия</label>
                                                        <select id="post_id" name="post_id"
                                                                class="form-control" required placeholder="Выберете вакансию">
                                                            <option value="-1" selected disabled>Загрузка</option>
                                                        </select>
                                                    </div>
                                                    <div id="files" class="form-group">
                                                        <label class=col-form-label" for="files[]">Изображение документа</label>
                                                    </div>
                                                    <div class="form-group"> <a href="#files" onclick="addFile()" class="btn btn-light">Добавить файл</a> </div>
                                                    <div class="form-group">
                                                        <label class="col-form-label" for="email">Email для обратной связи</label>
                                                        <input type="email" class="form-control" name="email" required placeholder="example@example.com"
                                                               value="{{ old('email') }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                            <input class="form-check-input" id="check1" name="check1" required type="checkbox"><label class="col-check-label" for="check1">Согласие на <a href="#">что-нибудь</a></label>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary mb-2">Отправить</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        @auth()</div>
    </div>@endif
    <script>
        let i = 0;
        function addFile()
        {
            i++;

            let Form = document.getElementById('files')
            let createtime = new Date().getTime();

            let Div = document.createElement('div');
            Div.id="div_"+createtime;
            Div.innerHTML = `<div class="form-group">
            <input type="file" required multiple class="form-control-file" name="files[]">
            <input type="text" required class="form-control" placeholder="Описание файла" name="description[]">
            <a href="#files" style="color: red" onclick="deleteElement(${createtime})">Удалить</a>
            </div>`;
            Form.appendChild(Div);

        }

        function deleteElement(createtime)
        {

            var Form = document.getElementById('files')
            Form.removeChild(document.getElementById("div_"+createtime));



        }

        ajaxReq(1);
        function ajaxReq(val){
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
            });

        }
        function insertIntoIndicatorSelector(array){
            let result = '';
            for(let item of array){
                result += `<option value="${item['id']}">${item['name']}</option>`
            }
            $('#post_id').html(result);
        }

    </script>
@endsection