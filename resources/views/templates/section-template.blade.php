@if(!empty($sections))
<div class="bluer">
    <a href="#">Poddziały</a>
</div>
@endif


@foreach($sections as $section)
<div class="row section-first">
    <div class="col-lg-1 section-picture my-auto">
        <img src="{{ asset(config('app.avatars_sections').$section->section_avatar) }}" style="width: 40px; height: 40px;" />
    </div>
    <div class="col-lg-8 section-this my-auto">
        <a href="{{ route('sekcja.show', $section->section_url) }}">{{ $section->name }}</a>
    </div>
    <div class="col-lg-1 section-count text-center my-auto small-text">
        <b>{{ $topics_count->where('id', $section->id)->first()['count'] }}</b> tematy
        <b>{{ $posts_count->where('id', $section->id)->first()['count'] }}</b> posty
    </div>
    <div class="col-lg-2 section-last-post my-auto">
        <div class="row">
            <div class="col-lg-4 my-auto last-topic-img d-flex justify-content-lg-end justify-content-center">
                <img src="{{ asset(config('app.avatars').$section->user_avatar) }}" style="width: 40px; height: 40px;" />
            </div>
            <div class="col-lg-8 small-text last-topic my-auto text-center">
                <p><a href="{{ route('temat.show', $section->topic_url) }}">{{ $section->topic_name }}</a></p>
                <p><a href="{{ route('uzytkownik.show', $section->login) }}">Przez {{ $section->login }}</a></p>
                <p>{{ $section->date }}</p>
            </div>
        </div>
    </div>
</div>
<hr class="nice-hr">
@endforeach

<!---------------------------------------------------------Nowy temat----------->
@if( auth()->check() )
    @if( $sekcja->status === 1 OR auth()->user()->haveSectionRights($sekcja) )
        <div class="mb-5"></div>
        <div class="d-flex justify-content-end">
            <a href="{{ route('sekcja.topic.create', $sekcja->url) }}">
                <button class="btn btn-primary pointer">Dodaj Nowy Temat</button>
            </a>
        </div>
    @endif
@endif

<div class="row">
    <div class="col-lg-12">
        <div class="row section-bluer">
            <div class="col-lg-12">
                <div class="bluer">
                    {{ $topics->total() }} tematów w tym forum
                </div>
            </div>
        </div>
        <!-- /////////////////////////////////////////////////////////////////////////////początek 1 kategori -->
        @foreach($topics as $topic)
        <div class="row section-first">
            <div class="col-lg-7 section-this my-auto p-margin0">
                <p>
                    <?php
                        if($topic->status === 0)
                        {
                            echo '<i class="fa fa-lock align-middle" aria-hidden="true"></i> ';
                        }
                        if($topic->pin === 1)
                        {
                            echo '<span class="badge badge-success align-middle"><i class="fa fa-thumb-tack" aria-hidden="true"></i></span> ';
                        }
                    ?>
                    <a href="{{ route('temat.show', $topic->url) }}" class="light-blue-link"> {{ $topic->name }}</a>

                </p>
                <p class="text-muted">
                Przez {{ $topic->posts->where('first', 1)->first()->users->login }}, {{ $topic->date }}
                </p>
            </div>
            <div class="col-lg-1 section-count text-center my-auto small-text p-margin0">
                <b>
                    {{ $topic->posts->count() }}
                </b>
                <p>ODPOWIEDZI
            </div>
            <div class="col-lg-1 section-count text-center my-auto small-text p-margin0">
                <b>{{ $topic->views }}</b>
                <p>WYŚWIETLEŃ
            </div>
            <div class="col-lg-3 section-last-post my-auto">
                <div class="row">
                    <div class="col-lg-4 my-auto last-topic-img d-flex justify-content-lg-end justify-content-center">
                        <img src="{{ asset(config('app.avatars').$topic->posts->sortbyDesc('date')->first()->users->avatar) }}" style="width: 40px; height: 40px" />
                    </div>
                    <div class="col-lg-8 small-text last-topic my-auto text-center">
                        <p><a href="{{ route('uzytkownik.show', $topic->posts->sortbyDesc('date')->first()->users->login) }}">Przez {{ $topic->posts->sortbyDesc('date')->first()->users->login }}</a></p>
                        <p>{{ $topic->posts->sortbyDesc('date')->first()->date }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <hr class="nice-hr">
        {{ $topics->links() }}
    </main>