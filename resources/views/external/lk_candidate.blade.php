@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            @if(isset($success))
                <div class="row justify-content-center">
                    <div class="col-md-11">
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">x</span>
                            </button>
                            {{ $success }}
                        </div>
                    </div>
                </div>
            @endif
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <h2>Личный кабинет соискателя</h2>
                    </div>
                    <div class="card-body">
                        <nav class="navbar">
                            @if($candidate->status === 'Не отправлено')
                                <a class="nav-item btn btn-outline-primary mb-2" href="{{ route('registration.create') }}">Отправить
                                    заявление</a>
                            @else
                                <a class="nav-item"></a>
                            @endif
                            <a class="nav-item btn btn-outline-danger mb-2"
                               href="{{ route('registration.logout') }}">Выйти</a>
                        </nav>
                        @php /** @var \App\Models\Candidate $candidate */ @endphp
                        <div class="form-group">
                            <h5>Статус вашего заявления: <a class="text-secondary">{{ $candidate->status }}</a></h5>
                            <h5>ФИО регистратора: <a class="text-secondary">{{ $candidate->head_name }}</a></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

