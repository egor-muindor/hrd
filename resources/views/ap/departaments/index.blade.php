@extends('layouts.app')

@section('content')

    <div class="row justify-content-center align-items-start">
        <div class="col-md-10">
            <div class="container">
                @include('ap.layouts.message_blog')
                <div class="row justify-content-center">
                    <div class="col-md-9">
                        <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
                            <a class="btn btn-primary " href="{{route('departament.create')}}">Добавить</a>
                        </nav>
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <table class="table table-hover table-responsive-md">
                                            <thead class="bg-white sticky-top">
                                            <th class="col-md-1">Ид</th>
                                            <th class="col-md">Название</th>
                                            <th class="col-md-2"></th>
                                            </thead>
                                            <tbody>
                                            @php /** @var App\Models\Departament $departament */ @endphp
                                            @foreach($departaments as $departament)
                                                <tr>
                                                    <td class="col-md-1">{{ $departament->id }}</td>
                                                    <td class="col-md">{{ $departament->name }}</td>
                                                    <td class="col-md-2"><a
                                                                href="{{ route('departament.show', $departament->id) }}"
                                                                class="btn btn-group">Подробнее</a></td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($departaments->total() > $departaments->count())
                            <br>
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            {{ $departaments->links() }}
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