<div class="sticky-top" >
    <div class="card">
        <div class="card-body">
            <div class="col-md">
                <div class="nav flex-column nav-pills" aria-orientation="vertical">
                    <a class="nav-link @if(Request::url() === route('registration.index')) active @endif" href="{{ route('registration.index') }}">Главная</a>
                    <a class="nav-link @if(Request::url() === route('application.index')) active @endif"  href="{{ route('application.index') }}">Список заявок</a>
                    <a class="nav-link @if(Request::url() === route('application.unchecked')) active @endif"  href="{{ route('application.unchecked') }}">Непроверенные заявки</a>
                </div>
            </div>
        </div>
    </div>
</div>

