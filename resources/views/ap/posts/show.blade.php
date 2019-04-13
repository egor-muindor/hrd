@extends('layouts.app')

@section('content')

    <div class="row justify-content-center align-items-start">
        <div class="col-md-10">
            <div class="container">
                @include('ap.layouts.message_blog')
                <div class="row justify-content-center">
                    <div class="col-md-9">
                        <nav class="nav navbar">
                            <div>
                                <a class="btn btn-secondary" href="{{ route('post.index') }}">Назад</a>
                            </div>
                            <div>
                                <a class="btn btn-primary" href="{{ route('post.edit', $post->id) }}">Редактировать</a>
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
                                                    <label class="col-form-label">Ид должности</label>
                                                    <input class="form-control" readonly value="{{ $post->id }}">
                                                    <label class="col-form-label">Вакансия</label>
                                                    <input name="name" class="form-control" readonly
                                                           placeholder="Название" value="{{ $post->name }}">
                                                    <label class="col-form-label">Отдел</label>
                                                    <input name="name" class="form-control" readonly
                                                           placeholder="Название"
                                                           value="{{ $post->departament->name }}">
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
        </div>
    </div>

@endsection