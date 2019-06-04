@extends('layouts.app')
@push ('sctipts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
@endpush
@section('content')
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <div class="row">
                                <a class="btn btn-secondary" href="{{ route('head.index') }}">Назад</a>
                                <div class="col text-center">
                                    <h2>Список сотрудников</h2></div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-responsive-sm">
                            <thead>
                            <th>#</th>
                            <th>ФИО</th>
                            <th>Email</th>
                            <th class="text-center">Действие</th>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr id="user_{{ $user->id }}">
                                    <td>{{ $user->id }}</td>
                                    <td class="text-wrap">{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <div class="form-row justify-content-center">
                                            <button type="button" class="btn btn-sm btn-danger"
                                               style="margin-bottom: 5px" onclick="delete_user({{ $user->id }})">Удалить</button>
                                        </div>
                                        <div class="form-row justify-content-center">
                                            <button type="button" class="btn btn-sm btn-warning">Сбросить пароль</button>
                                        </div>
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
    @if($users->total() > $users->count())
        <br>
        <div class="row justify-content-center">
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    @endif
    <script>
        function delete_user (id){
            if (!confirm('Вы действительно хотите удалить пользователя?')){
                return false
            }
            $.ajax({
                type:'DELETE',
                url:'{{route('admin.user.delete')}}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {id: id},
                success:function(resp){
                    $(`#user_${id}`).hide();
                },
                error: function (resp) {
                    alert(resp.responseText);
                }
            });
        }
    </script>

@endsection

