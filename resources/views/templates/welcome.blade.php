@if(!Auth::check())
    <div class="welcome">
        <div class="margin-bottom-small"></div>
        <header class="welcome-header">
            {{ config('app.welcome_message') }}
        </header>
        <div class="welcome-text">
            <small>{{ config('app.welcome_description') }}</small>
        </div>
        <div class="welcome-action">
            <button type="button" class="btn btn-secondary pointer" data-toggle="modal" data-target="#exampleModal"><span class="glyphicon glyphicon-log-in"></span> Zaloguj się</button>
            <a href="{{ route('uzytkownik.create') }}"><button type="button" class="btn btn-secondary pointer"><span class="glyphicon glyphicon-fire"></span> Zarejestruj się</button></a>
        </div>
    </div>
@endif