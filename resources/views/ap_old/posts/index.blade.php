@extends('layouts.app')

@section('content')

    <div class="row justify-content-center align-items-start">
        <div class="col-md-10">
            <div class="container">
                @include('ap_old.layouts.message_blog')
                <div class="row justify-content-center">
                    <div class="col-md-9">
                        <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
                            <a class="btn btn-primary " href="{{route('post.create')}}">Добавить</a>
                        </nav>
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <table class="table table-hover table-responsive-md">
                                            <thead class="bg-white sticky-top">
                                            <th class="col-md-1">Ид</th>
                                            <th class="col-md-4">Отдел</th>
                                            <th class="col-md-5">Название</th>
                                            <th class="col-md-2"></th>
                                            </thead>
                                            <tbody>
                                            @php /** @var App\Models\Post $post */ @endphp
                                            @foreach($posts as $post)
                                                <tr>
                                                    <td class="col-md-1">{{ $post->id }}</td>
                                                    <td class="col-md-4"><a
                                                                href="{{route('departament.show', $post->departament->id)}}">{{ $post->departament->name }}</a>
                                                    </td>
                                                    <td class="col-md-5">{{ $post->name }}</td>
                                                    <td class="col-md-2"><a href="{{ route('post.show', $post->id) }}"
                                                                            class="btn btn-group">Подробнее</a></td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($posts->total() > $posts->count())
                            <br>
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            {{ $posts->links() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection