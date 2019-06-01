@php /** @var \App\Models\Invite $invite */ @endphp
@php $invite->update(['status' => 'Доставлено']);@endphp
<body>

<h2>Регистрация в системе обработки документов Московского политеха.</h2>
<p>Вы получили это письмо, потому что ваш email был указан в качестве адресата. Используйте ссылку для регистрации
в системе:
    <a href="{{ route('registration.register',
                     ['token' => $invite->token, 'email'=> $invite->email]) }}">
        {{ route('registration.register',
                ['token' => $invite->token, 'email'=> $invite->email]) }}
    </a>.</p>
<br>
<p>Если ссылка выше не работает, обратитесь в отдел кадров.</p>

</body>
