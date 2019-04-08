@php /** @var \App\Models\Application $application */ @endphp
<body>
<h2>Поступила новая заявка от {{ $application->last_name }} {{ $application->first_name }} {{ $application->middle_name }}</h2>
<a href="{{ route('application.show', $application->id) }}"><h3>Ссылка на заявку</h3></a><br>
<div>

    <table>
        <tr>
            <td>
                <label for="name">ФИО:</label>
            </td>
            <td><input id="name" size="30" readonly
                      value="{{ $application->last_name }} {{ $application->first_name }} {{ $application->middle_name }}"></td>

        </tr>
        <tr>
            <td><label>Email: </label></td>
            <td><input readonly size="30" value="{{ $application->email }}"></td>
        </tr>
        <tr>
            <td><label>Отдел:</label></td>
            <td><input readonly size="30" value="{{ $application->post->departament->name }}"></td>
        </tr>

        <tr>
            <td><label>Должность: </label></td>
            <td><input readonly size="30" value="{{ $application->post->name }}"></td>
        </tr>
        <tr>
            <td><label>Серия и номер паспорта: </label></td>
            <td><input readonly size="30" value="{{ $application->passport_id }}"></td>
        </tr>
        <tr>
            <td><label>СНИЛС: </label></td>
            <td><input readonly size="30" value="{{ $application->snils }}"></td>
        </tr>
        <tr>
            <td><label>ИНН: </label></td>
            <td><input readonly size="30"  value="{{ $application->inn }}"></td>
        </tr>

        <tr>
            <td><label>Предыдущие места работы</label></td>
            <td><textarea cols="23" readonly>{{ $application->employment_history }}</textarea></td>
        </tr>

        <tr>
            <td><label>Научные работы</label></td>
            <td><textarea cols="23" readonly>{{ $application->scientific_works }}</textarea></td>
        </tr>
    </table>

</div>
@if(count($addictions)>0)
    <div>
        <h2 class="card-title">Приложения</h2>
        @php /** @var \App\Models\Addiction $addiction */ @endphp
        <table>
            <thead>
            <th>Описание</th>
            <th>Ссылка</th>
            </thead>
            <tbody>
            @foreach($addictions as $addiction)
                <tr>
                    <td>{{$addiction->description}}</td>
                    <td>
                        <a href="{{ url('/') }}{{ \Illuminate\Support\Facades\Storage::url($addiction->file) }}">Открыть</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endif

</body>
