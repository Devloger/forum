<div class="bg-gray p-3 text-center p-margin0">
    <h2 class="text-gray">Zarejestruj się</h2>
    <p class="text-muted">Masz już konto? Zaloguj się</p>
</div>
<form method="post" action="{{ route('uzytkownik.store') }}" class="dark-input p-3 text-gray">
    {{ csrf_field() }}
    {{ method_field('POST') }}
    <div class="input-label">Nazwa użytkownika <span class="text-danger">*</span></div> <input type="text" name="login" maxlength="35" minlength="3" required/>

    @if( $errors->has('login') )
        <small class="form-text text-danger">{{ $errors->first('login') }}</small>
    @endif

    <br />

    <div class="input-label">Adres e-mail <span class="text-danger">*</span></div> <input type="email" name="email" maxlength="255" minlength="3" required/>

    @if( $errors->has('email') )
        <small class="form-text text-danger">{{ $errors->first('email') }}</small>
    @endif
    
    <br />
    <div class="input-label">Hasło <span class="text-danger">*</span></div> <input type="password" name="password" maxlength="255" minlength="3" required/><br />
    <div class="input-label">Potwierdź hasło <span class="text-danger">*</span></div> <input type="password" name="password_confirmation" maxlength="255" minlength="3" required/><br />
    <hr class="" />
    <div class="input-label">Kapcia <span class="text-danger">*</span></div> <input type="password" name="captcha" /><br />
    <hr />
    <input type="checkbox" name="spam"/>Wyrażam zgodę na otrzymywanie za pośrednictwem środków komunikacji elektronicznej informacji handlowych w rozumieniu ustawy z dnia 18 lipca 2002 r. o świadczeniu usług drogą elektroniczną (Dz. U. z 2002 r., Nr 144 poz. 104). Szczegółowe zasady przetwarzania danych osobowych określa Polityka prywatności<br />
    <input type="checkbox" name="policy" required/>Zgadzam się z Warunkami użytkowania i Polityką prywatności <span class="text-danger">*</span> <br />
				<input type="submit" class="btn btn-primary mt-3 d-block mx-auto" value="Zarejestruj moje konto"/>
</form>
<div class="mb-4"></div>
</main>
@if($errors->any())
    <div class="alert alert-danger flash_message" role="alert">
        <strong>Błąd!</strong> Rejestracja się nie powiodła! Wprowadzono błędne dane!
    </div>
@endif
@if(session('done'))
    <div class="alert alert-success flash_message" role="alert">
        <strong>Udało się!</strong> Konto zostało pomyślnie utworzone!
    </div>
@endif