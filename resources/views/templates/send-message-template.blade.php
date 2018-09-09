<div class="bg-grayer p-3 m-0 rounded justify-content-center">
    <h2>Wyślij wiadomość do użytkownika: <strong>{{ $user->login }}</strong></h2>

    <div class="text-center">
        <img src="{{ asset(config('app.avatars').$user->avatar) }}" style="width: 120px; height: 120px;" />
    </div>
    <!-----------------------Formularz do: Wysylania wiadomosci--------------->
    
    <form method="POST" action="{{ route('wiadomosci.store') }}">
    
        {{ csrf_field() }}
        {{ method_field('POST') }}
        <input type="hidden" name="user" value="{{ $user->id }}" />
    
        <div class="form-group">
            <label for="topic">Temat wiadomości</label>
            <input class="form-control" name="topic" type="text" minlength="3" maxlength="150" required />
        </div>

        <div class="form-group">
            <label for="msg">Treść wiadomości</label>
            <textarea class="form-control" name="msg" id="msg" cols="30" rows="10" required minlength="3"></textarea>
        </div>
        
        <div class="text-center">
            <button type="submit" class="btn btn-primary pointer">
                Wyślij wiadomość!
            </button>
        </div>
        
    </form>
</div>