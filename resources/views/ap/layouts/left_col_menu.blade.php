<div class="sticky-top justify-content-center">

    <div class="card">
        <div class="card-body">
            <div class="col-md">

                <div class="nav flex-column nav-pills" aria-orientation="vertical">
                    <a class="nav-link @if(Request::url() === route('registration.index')) active @endif" href="{{ route('registration.index') }}">Главная</a>
                    <a class="nav-link @if(Request::url() === route('application.index')) active @endif"  href="{{ route('application.index') }}">Список заявок</a>
                </div>
            </div>
        </div>
    </div>
</div>

