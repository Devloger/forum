<div class="bg-grayer p-3 m-0 rounded justify-content-center">
    <h2>Aktualizacja danych profilowych</h2>
    <form method="post" action="{{ route('uzytkownik.update', $uzytkownik->login) }}" enctype="multipart/form-data" style="max-width: 500px;" class="mx-auto">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <h3 class="text-center"><a href="{{ route('uzytkownik.show', $uzytkownik->login) }}">{{ $uzytkownik->login }}</a></h3>
        <div class="mx-auto" style="width: 100px; height: 100px;">
            <img src="{{ asset(config('app.avatars').$uzytkownik->avatar) }}" style="width: 100px; height: 100px;"/>
        </div>
        <div class="form-group">
            <label for="birth">Data Urodzenia</label>
            <input id="birth" name="birth" type="date" class="form-control" value="{{ substr($uzytkownik->birth, 0, 10) }}" required>
        </div>
        <div class="form-group">
            <label for="sex">Płeć</label>
            <select id="sex" name="sex" class="form-control" required>
                <option {{ $uzytkownik->sex === 'Kobieta' ? '' : 'selected' }}>Mężczyzna</option>
                <option {{ $uzytkownik->sex === 'Kobieta' ? 'selected' : '' }}>Kobieta</option>
            </select>
        </div>
        <div class="form-group">
            <label for="about">O mnie</label>
            <textarea id="about" name="about" type="text" class="form-control" rows="8" maxlength="500">{{ $uzytkownik->about }}</textarea>
        </div>
        <div class="form-group">
            <label for="avatar">Avatar</label>
            <input id="avatar" name="avatar" type="file" class="form-control-file" accept="image/*">
            <small class="form-text text-muted">Maksymalny rozmiar: {{ config('app.max_avatar_size') }} Kb</small>
        </div>
        <div class="mx-auto text-center mt-2 mb-3 pointer">
            <input type="submit" class="btn btn-success btn-lg pointer" value="Zaktualizuj!">
        </div>
    </form>
</div>