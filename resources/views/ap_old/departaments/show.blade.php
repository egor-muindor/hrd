@extends('layouts.app')

@section('content')

    <div class="row justify-content-center align-items-start">
        <div class="col-md-10">
            <div class="container">
                @include('ap_old.layouts.message_blog')
                <div class="row justify-content-center">
                    <div class="col-md-9">
                        <nav class="nav navbar">
                            <div>
                                <a class="btn btn-secondary" href="{{ route('departament.index') }}">Назад</a>
                            </div>
                            <div>
                                <a class="btn btn-primary" href="{{ route('departament.edit', $departament->id) }}">Редактировать</a>
                            </div>
                        </nav>
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        @php /** @var App\Models\Departament $departament */@endphp
                                        <div class="tab-content">
                                            <div class="tab-pane active">
                                                <div class="form-group">
                                                    <label class="col-form-label">Ид отдела</label>
                                                    <input class="form-control" readonly value="{{ $departament->id }}">
                                                    <label class="col-form-label">Название отдела</label>
                                                    <input name="name" class="form-control" readonly
                                                           placeholder="Название" value="{{ $departament->name }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if(count($posts)>0)
                                    <br>
                                    <div class="card">
                                        <div class="card-body">
                                            <h1 class="card-title">Вакансии отдела "{{ $departament->name }}"</h1>
                                            @php/** @var App\Models\Post $post */@endphp
                                            <table class="table table-hover table-responsive-md">
                                                <thead class="bg-white sticky-top">
                                                <th class="col-md-1">Ид</th>
                                                <th class="col-md">Название</th>
                                                <th class="col-md-2"></th>
                                                </thead>
                                                <tbody>
                                                @foreach($posts as $post)
                                                    <tr>
                                                        <td class="col-md-1">{{ $post->id }}</td>
                                                        <td class="col-md">{{ $post->name }}</td>
                                                        <td class="col-md-2"><a
                                                                    href="{{ route('post.show', $post->id) }}"
                                                                    class="btn btn-group">Подробнее</a></td>
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

@endsection