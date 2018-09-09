<h5>Wiadomości:</h5>

{{ !$messages ? 'Brak wiadomosci!' : '' }}

@foreach( $messages as $message )

    <div class="mb-3 rounded p-2" style="border: 1px solid #0275d8">
        <div class="d-flex">
            <div class="" style="flex: 1;">
                <p>
                    Od: <a href="">

                    </a>
                </p>
            </div>
            <div class="" style="flex: 1;">
                <p>
                    Temat: {{ $message->name }}
                </p>
            </div>
            <div class="" style="flex: 1;">
                <p>
                    Data: {{ $message->date }}
                </p>
            </div>
        </div>
        {{--{{ dd($message->author === 242 ? 'eee' : 'dupa') }}--}}
        {!! $message->author === $uzytkownik->id ? '<span class="badge badge-success">Napisana przez ciebie</span> ' : '' !!}
        {!! ($message->read === 0 AND $message->author !== $uzytkownik->id) ? '<span class="badge badge-danger">Nieodczytana</span> ' : '' !!}
        Skrócona treść ostatniej wiadomości: <span class="text-muted">{{ str_limit($message->content, 100) }}</span>
        <div class="text-center">
            <a class="btn btn-primary btn-sm pointer" href="{{ route('wiadomosci.show', $message->id) }}">
                Przejdź do wiadomości
            </a>
        </div>
    </div>

@endforeach