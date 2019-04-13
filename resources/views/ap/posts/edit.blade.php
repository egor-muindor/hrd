@extends('layouts.app')

@push ('sctipts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
@endpush

@section('content')

    <div class="row justify-content-center align-items-start">
        <div class="col-md-10">
            <div class="container">
                @include('ap.layouts.message_blog')
                <form method="post" action="{{ route('post.update', $post->id) }}"
                      enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-md-9">
                            <nav class="nav navbar">
                                <div>
                                    <a class="btn btn-secondary"
                                       href="{{ route('post.show', $post->id) }}">Назад</a>
                                </div>
                                <div>
                                    <a class="btn btn-danger " id="delete_app" data-toggle="modal"
                                       data-target="#myModal" onclick="">Удалить</a>
                                    <button class="btn btn-primary" type="submit">Сохранить</button>
                                </div>
                            </nav>
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            @php /** @var Post $post */use App\Models\Post; @endphp
                                            <div class="tab-content">
                                                <div class="tab-pane active">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Ид должности</label>
                                                        <input class="form-control" readonly value="{{ $post->id }}">
                                                        <label class="col-form-label">Вакансия</label>
                                                        <input name="name" class="form-control"
                                                               placeholder="Название" value="{{ $post->name }}">
                                                        <label class="col-form-label">Отдел</label>
                                                        <select id="departament_id" name="departament_id"
                                                                required class="form-control">
                                                            @php /** @var Departament $departament */use App\Models\Departament; @endphp
                                                            @foreach ($departaments as $departament)
                                                                <option @if($departament->id === $post->departament_id) selected
                                                                        @endif value="{{ $departament->id }}">{{ $departament->name }}</option>
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

    {{--     Модальное окно удаления вакансии --}}
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Вы хотите удалить вакансию {{ $post->name }} из
                        отдела {{$post->departament->name}}?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('post.destroy', $post->id) }}" method="post">
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

@endsection