@extends('layouts.app')
@push ('sctipts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
@endpush
@section('content')
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <a class="btn btn-secondary" href="{{ route('head.index') }}">Назад</a>
                            <div class="col text-center">
                                <h2>Список отправленных приглашений</h2>
                            </div>
                        </div>
                        <hr>
                        <table class="table table-hover">
                            <thead>
                            <th>#</th>
                            <th>Email</th>
                            <th>Статус</th>
                            <th>Отправитель</th>
                            <th>Действие</th>
                            </thead>
                            <tbody>
                            @foreach($invites as $invite)
                                <tr>
                                    <td>{{ $invite->id }}</td>
                                    <td>{{ $invite->email }}</td>
                                    <td>{{ $invite->status }}</td>
                                    <td>{{ $invite->head_name }}</td>
                                    <td>
                                        <button id="button_{{$invite->id}}" class="btn btn-sm btn-outline-primary" onclick="retryRequest({{ $invite->id }})" type="button">Отправить
                                            повторно
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($invites->total() > $invites->count())
        <br>
        <div class="row justify-content-center">
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        {{ $invites->links() }}
                    </div>
                </div>
            </div>
        </div>
    @endif
    <script>
        function retryRequest(id){
            $(`#button_${id}`).attr('style', 'display: none;');
            $.ajax({
                type:'POST',
                url:'{{route('invites.retry')}}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {id: id},
                success:function(resp){
                    alert(resp.message);
                }
            });

        }
    </script>

@endsection

