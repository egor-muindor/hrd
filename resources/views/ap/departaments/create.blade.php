@extends('layouts.app')

@section('content')

    <div class="row justify-content-center align-items-start">
        <div class="col-md-10">
            <div class="container">
                @include('ap.layouts.message_blog')
                <form method="post" action="{{ route('departament.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-md-9">
                            <nav class="nav navbar">
                                <div>
                                    <a class="btn btn-secondary" href="{{ route('departament.index') }}">Назад</a>
                                </div>
                                <button class="btn btn-primary" type="submit">Создать</button>
                            </nav>
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            @php /** @var Departament $departament */use App\Models\Departament; @endphp
                                            <div class="tab-content">
                                                <div class="tab-pane active">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Название отдела</label>
                                                        <input name="name" required class="form-control"
                                                               placeholder="Название" value="">
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