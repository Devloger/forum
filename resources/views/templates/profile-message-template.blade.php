<h5>Wiadomości:</h5>

<div class="row mb-4">
    <div class="col-lg-1">
        <img src="{{ asset(config('app.avatars') . ($wiadomosci->from !== $uzytkownik->id ? $wiadomosci->users->avatar : $wiadomosci->To->avatar) ) }}" style="width: 40px; height: 40px;"/>
    </div>
    <div class="col-lg-10">

    </div>
    <div class="col-lg-1 text-right">
        <img src="{{ asset(config('app.avatars').$uzytkownik->avatar) }}" style="width: 40px; height: 40px;"/>
    </div>
</div>

@foreach( $wiadomosci->messages()->orderBy('date')->get() as $wiadomosc )

@if( $wiadomosc->from === $uzytkownik->id )
    {{---------------------------------------Autor--}}
    <div class="row mb-3">
        <div class="col-lg-6 offset-lg-6">
            <div class="bg-primary rounded p-3">
                {{ $wiadomosc->content }}
            </div>
            <small>{{ $wiadomosc->date }}</small>
        </div>
    </div>

@else
    {{---------------------------------------Nadawca--}}

    <div class="row mb-3">
        <div class="col-lg-6">
            <div class="bg-faded rounded p-3 text-muted">
                {{ $wiadomosc->content }}
            </div>
            <small>{{ $wiadomosc->date }}</small>
        </div>
    </div>
@endif

@endforeach


<!-----------------------Formularz do: Wysylanie odpowiedzi na Wiadomosc--------------->

<form method="POST" action="{{ route('wiadomosci.update', $wiadomosci) }}">

    {{ csrf_field() }}
    {{ method_field('PATCH') }}

    <div class="form-group">
        <label for="msg">Treść</label>
        <input type="text" name="msg" class="form-control" id="msg" placeholder="" required minlength="3">
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-primary pointer">
            Wyślij wiadomość!
        </button>
    </div>

</form>