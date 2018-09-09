<div class="bg-grayer p-3 m-0 rounded justify-content-center">
    <h2>Nowy Temat</h2>
    <form method="post" action="{{ route('sekcja.topic.store', $sekcja) }}" enctype="multipart/form-data" style="width: 500px;" class="mx-auto">
        {{ csrf_field() }}
        {{ method_field('POST') }}
        <h3 class="text-center">Nowy Temat w Sekcji: {{ $sekcja->name }}</h3>
        <div class="mx-auto" style="width: 100px; height: 100px;">
            <img src="{{ asset(config('app.avatars_sections').$sekcja->avatar) }}" style="width: 100px; height: 100px;"/>
        </div>
        <div class="form-group">
            <label for="name">Tytuł</label>
            <input id="name" name="name" type="text" class="form-control" minlength="5" maxlength="150" required>
        </div>
        <div class="form-group">
            <label for="content">Treść</label>
            <textarea id="content" name="content" type="text" class="form-control" rows="8" minlength="10" required></textarea>
        </div>
        <div class="mx-auto text-center mt-2 mb-3 pointer">
            <input type="submit" class="btn btn-success btn-lg pointer" value="Dodaj Nowy Temat!">
        </div>
    </form>
</div>
</main>