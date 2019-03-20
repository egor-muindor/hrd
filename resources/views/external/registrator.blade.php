@extends('layouts.app')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
                                                    <input class="form-control " name="last_name" required placeholder="Фамилию" value="{{ old('first_name') }}">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label class="col-form-label" for="first_name" >Имя</label>
                                                    <input class="form-control " name="first_name" required placeholder="Имя" value="{{ old('first_name') }}">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label class="col-form-label" for="middle_name">Отчество</label>
                                                    <input class="form-control " name="middle_name" required placeholder="Отчество" value="{{ old('middle_name') }}">
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label class="col-form-label" for="passport_id">Серия и номер паспорта</label>
                                                    <input class="form-control" name="passport_id" required
                                                           placeholder="Например 1234 123456" value="{{ old('passport_id') }}">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label class="col-form-label" for="snils">СНИЛС</label>
                                                    <input class="form-control" name="snils" required
                                                           placeholder="Например 123-456-789-12" value="{{ old('snils') }}">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label class="col-form-label" for="inn">ИНН</label>
                                                    <input class="form-control" name="inn" required
                                                           placeholder="ИНН" value="{{ old('inn') }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label" for="employment_history">Трудовая история (Трудовая книжка)</label>
                                                <textarea class="form-control" name="employment_history"
                                                          required placeholder="Введите предыдущие места работы"
                                                          value="{{ old('employment_history') }}"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label" for="departament_id">Отдел</label>
                                                <select onchange="ajaxReq(this.value)" id="departament_id" name="departament_id" value="{{ old('departament_id') }}"
                                                class="form-control" placeholder="Выберете отдел">
                                                    @foreach($departaments as $departament)
                                                        <option value="{{ $departament->id }}">{{ $departament->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label" for="post_id">Вакансия</label>
                                                <select id="post_id" name="post_id" value="{{ old('post_id') }}"
                                                        class="form-control" required placeholder="Выберете вакансию">
                                                    <option value="-1" selected disabled>Загрузка</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class=col-form-label" for="test_data">Изображение документа</label>
                                                <input type="file" multiple class="form-control-file" name="test_data"
                                                       value="{{ old('test_data') }}">
                                            </div>

                                            <div class="form-group">
                                                <label class="col-form-label" for="email">Email для обратной связи</label>
                                                <input type="email" class="form-control" name="email" required placeholder="example@example.com"
                                                       value="{{ old('email') }}">
                                            </div>
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <label class="col-check-label" for="check1"><input class="form-check-input" name="check1" required type="checkbox">Согласие на <a href="#">что-нибудь</a></label>
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
    <script>
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