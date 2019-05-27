@extends('layouts.app')

@section('content')

    <div class="row justify-content-center align-items-start">
        <div class="col-md-10">
            <div class="container">
                @include('ap_old.layouts.message_blog')
                <form method="post" action="{{ route('post.store') }}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-md-9">
                            <nav class="nav navbar">
                                <div>
                                    <a class="btn btn-secondary"
                                       href="{{ route('post.index') }}">Назад</a>
                                </div>
                                <div>
                                    <button class="btn btn-primary" type="submit">Создать</button>
                                </div>
                            </nav>
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            @php /** @var App\Models\Post $post */ @endphp
                                            <div class="tab-content">
                                                <div class="tab-pane active">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Название вакансии</label>
                                                        <input name="name" class="form-control"
                                                               placeholder="Название" value="">
                                                        <label class="col-form-label">Отдел</label>
                                                        <select id="departament_id" name="departament_id"
                                                                required class="form-control">
                                                            @php /** @var App\Models\Departament $departament */ @endphp
                                                            @foreach ($departaments as $departament)
                                                                <option value="{{$departament->id}}">{{ $departament->name }}</option>
                                                            @endforeach
                                                        </select>
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
            </div>
        </div>
    </div>


@endsection