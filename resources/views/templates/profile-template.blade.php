<div class="row bg-grayer p-3 m-0 rounded">
    <div class="col-lg-4">
        <div class="d-flex flex-wrap align-items-lg-center h-margin-0 p-margin0">
            <div class="mr-4">
                <img src="{{ asset(config('app.avatars').$uzytkownik->avatar) }}" style="width: 80px; height: 80px"/>
            </div>
            <div class="">
                <p class="h5">
                    @for($x=0; $x<$uzytkownik->ranks->stars; $x++)
                    <i class="fa fa-diamond m-1" aria-hidden="true"></i>
                    @endfor
                </p>
                <h3>{{ $uzytkownik->login }} </h3>
                <p class="small">{{ $uzytkownik->groups->name }}</p>
                <p class="small">{{ $uzytkownik->ranks->name }}</p>
            </div>
        </div>
    </div>
    <div class="col-lg-5 offset-lg-2 align-self-end">
        <div class="row align-items-lg-end">
            <div class="col-lg">
                ZAWARTOŚĆ<br>
                {{ $uzytkownik->posts->count() }}
            </div>
            <div class="col-lg">
                Rejestracja<br>
                {{ $uzytkownik->register }}
            </div>
            <div class="col-lg">
                OSTATNIO<br>
                {{ \Carbon\Carbon::setLocale('pl') }}
                {{ $uzytkownik->last_login->diffForHumans() }}
            </div>
        </div>
    </div>
</div>
<div class="row pb-3">
    <div class="col-lg-3">
        <div class="bg-gray p-3 mt-3">
            <div class="p-margin-0 rounded mb-3 {{ $uzytkownik->reputations->sum('value') >=0 ? 'bg-success' : 'bg-danger' }} p-2 text-center border-right-gray">
                <p>Reputacja</p>
                <p>{{ $uzytkownik->reputations->sum('value') }}</p>
                <p>{{ $uzytkownik->reputations->sum('value') >=0 ? 'Pozytywny' : 'Negatywny' }}</p>
            </div>
            <div class="p-margin-0 rounded {{ $uzytkownik->warns->sum('value') >0 ? ( $uzytkownik->warns->sum('value') >= config('app.warns_max') ? 'bg-danger' : 'bg-warning' ) : 'bg-inverse' }} p-2 text-center border-right-gray">
                <p>Ostrzeżenia</p>
                <p>{{ $uzytkownik->warns->sum('value') }}</p>
                <p>{{ $uzytkownik->warns->sum('value') >0 ? ( $uzytkownik->warns->sum('value') >= config('app.warns_max') ? 'Zniszczony' : 'Brudny' ) : 'Czysty' }}</p>
            </div>
        </div>


        {{-----------------------------------------Button do wyslania wiadomosci--}}

{{--        {{ dd(\Illuminate\Support\Facades\Gate::check('sendMessage', $uzytkownik)) }}--}}

        @canSendMessage($uzytkownik)
        <div class="mt-3 mb-3 text-center">
            <a class="btn-primary pointer btn" href="{{ route('uzytkownik.message.create', $uzytkownik) }}">
                Wyślij prywatną wiadomość
            </a>
        </div>
        @endcanSendMessage



        <div class="bg-primary p-1">
            <div class="bg-grayer p-3">
                O {{ $uzytkownik->login  }}
            </div>
        </div>
        <div class="bg-grayer p-3 small ">
            <p>Urodziny: {{ $uzytkownik->login  }}</p>
            <p>Urodziny: {{ $uzytkownik->birth->format('Y-m-d')  }}</p>
            <p>Płeć: {{ $uzytkownik->sex  }}</p>
            <p>O mnie: {{ $uzytkownik->about  }}</p>
        </div>
    </div>

    <div class="col-lg-9 mb-3">
        <div class="p-3 bg-gray mt-3">
            @include($what)
        </div>
    </div>
</div>
</main>