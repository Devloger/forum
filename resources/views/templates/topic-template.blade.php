<div class="bg-gray">
    <div class="media p-3 p-margin0">
        <a href="{{ route('uzytkownik.show', $temat->posts->where('first', 1)->first()->users->login) }}" class="d-flex mr-3 align-self-center"><img src="{{ asset(config('app.avatars').$temat->posts->where('first', 1)->first()->users->avatar) }}" style="width: 32px; height: 32px;" /></a>
        <div class="media-body">
            <p>{{ $temat->name }}</p>
            <p class="small text-muted">Rozpoczęty przez <a href="{{ route('uzytkownik.show', $temat->posts->where('first', 1)->first()->users->login) }}" class="light-blue-link">{{ $temat->posts->where('first', 1)->first()->users->login }}</a>, {{ $temat->date }}</p>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <div class="row section-bluer">
            <div class="col-lg-12">
                <div class="bluer">
                    {{ $temat->posts->count() }} postów w tym temacie, Temat w sekcji: <a class="btn btn-info cursor btn-sm ml-1" href="{{ route('sekcja.show', $temat->sections->url) }}">{{ $temat->sections->name }}</a>
                </div>
            </div>
        </div>
        <div class="margin-bottom-small"></div>
        <!-----------------------------------------------------Button odpowiedz na ten temat------------->
        {{--{{ dd( auth()->user()->haveSectionRights($temat->sections) ) }}--}}
        @answerTopic($temat)
            <div class="text-right mb-2">
                <a class="btn btn-primary pointer" href="#new_post">Odpowiedz na ten temat</a>
            </div>
        @endanswerTopic
        <!-- /////////////////////////////////////////////////////////////////////////////początek POSTA -->
        @foreach( $posts as $post )
        <div class="row section-first bg-gray">
            <div class="col-lg-2 text-center text-light-blue my-auto">
                <h5 class="mb-0"><a href="{{ route('uzytkownik.show', $post->users->login) }}">{{ $post->users->login }}</a></h5>
            </div>
            <div class="col-lg text-light-blue">
                @if($post->first === 1)
                <span class="badge badge-success">Autor tematu</span>
                @endif
                Napisano {{ $post->date->format('Y-m-d') }}
                @if( auth()->check() )
                    @if( $post->users->id !== auth()->user()->id )
                        · <a href="#" data-toggle="modal" data-target="#reportModal" id="report" data-post="{{ $post->id }}">Zgłoś post</a>
                    @endif
                @endif
            </div>
        </div>
        <hr class="nice-hr">
        <div class="row section-first" data-post="{{ $post->id }}">
            <div class="col-lg-2 text-center text-grayer my-auto p-2">
                <p class="h6">{{ $post->users->ranks->name }}</p>
                <p class="h5">
                    @for($x=0; $x<$post->users->ranks->stars; $x++)
                        <i class="fa fa-diamond m-1" aria-hidden="true"></i>
                    @endfor
                </p>
                <a href="{{ route('uzytkownik.show', $post->users->login) }}"><img class="mb-1 border-gray" src="{{ asset(config('app.avatars').$post->users->avatar) }}" style="width: 112px; height: 112px;"/></a>
                <p class="small m-0">{{ $post->users->groups->name }}</p>

                <!-----------------------------------------------------------------------------Reputacja----------->

                <p class="m-0"><span class="badge {{ $post->users->reputations->sum('value') >=0 ? 'bg-success' : 'bg-danger' }}"><i class="fa fa-plus-square" aria-hidden="true"></i> {{ $post->users->reputations->sum('value') }}</span></p>
                <p class="m-0"><span class="badge {{ $post->users->warns->sum('value') >0 ? ( $post->users->warns->sum('value') >= config('app.warns_max') ? 'bg-danger' : 'bg-warning' ) : 'bg-inverse' }}"><i class="fa fa-minus-square" aria-hidden="true"></i> {{ $post->users->warns->sum('value') }}</span></p>
                <p class="text-muted">{{ $post->users->posts->count() }} postów</p>

                <!------------------------------------------------------------------------Button do edycji posta--->
                @editPost( $post )
                    <button class="btn btn-info btn-sm pointer post-edit">
                        Edytuj Post
                    </button>
                @endeditPost

            </div>
            <div class="col-lg-10 text-gray p-2">
                <div class="post-content">
                    <p>
                        {{ $post->content }}
                    </p>
                </div>
                <!-----------------------Formularz do: Edycja Posta--------------->

                <form method="POST" action="{{ route('temat.post.edit') }}" style="display: none;" class="form post-update">

                    {{ csrf_field() }}
                    {{ method_field('POST') }}
                    <input type="hidden" value="{{ $post->id }}" name="pid" required/>

                    <div class="form-group">
                        <label for="post">Treść</label>
                        <textarea type="text" name="post" class="form-control" id="post" placeholder="" onkeyup="textAreaAdjust(this)" minlength="2" required></textarea>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary pointer">
                            Zaktualizuj Post!
                        </button>
                    </div>

                </form>


            </div>
            <div class="offset-lg-2 small col-lg-9">
                @if( $post->reputations->count() !== 0 )
                    @foreach( $post->reputations as $reputation )
                        <a href="{{ route('uzytkownik.show', $reputation->users->login) }}">{{ $reputation->users->login }}</a>,
                    @endforeach
                    <span class="badge badge-danger"><i class="fa fa-heart" aria-hidden="true"></i></span> Lubią to.
                @endif
            </div>
            <!--------------------------------------------------------------------------Like----------------->
            @if( auth()->check() )
                @if( $post->reputations->where('from', auth()->user()->id )->count() === 0 AND $post->author !== auth()->user()->id )
                    <div class="col-lg-1 clearfix">
                        <form method="post" action="{{ route('temat.post.like') }}">
                            {{ method_field('POST') }}
                            {{ csrf_field() }}
                            <input type="hidden" name="post" value="{{ $post->id }}" />
                            <button class="btn btn-danger btn-sm pointer" type="submit"><i class="fa fa-heart" aria-hidden="true"></i> Lubię to!</button>
                        </form>
                    </div>
                @endif
            @endif
        </div>
        <hr class="nice-hr">
        @endforeach
        {{ $posts->links() }}
        <!--------------------------------------------------------Nowy Post-------------->
        @if( auth()->check() )
            @if( $temat->status === 1 OR auth()->user()->haveSectionRights($temat->sections) )
                <div class="row mt-4 mb-4 bg-grayer p-3 m-4 rounded">
                    <div class="col-lg-1 my-auto">
                        <div class="text-center">
                            <img class="mb-1 border-gray" src="{{ asset(config('app.avatars').auth()->user()->avatar) }}" style="width: 80px; height: 80px;"/>
                        </div>
                    </div>
                    <div class="col-lg-11 my-auto">
                        <div class="text-center">
                            <form id="new_post" method="POST" action="{{ route('temat.post.store', $temat) }}">
                                {{ method_field('POST') }}
                                {{ csrf_field() }}
                                <textarea name="post" class="text-muted p-2 mb-3" style="width: 100%; height: 100%;" placeholder="Odpowiedz..." onkeyup="textAreaAdjust(this)" minlength="2" required></textarea>
                                <input type="submit" class="btn btn-success pointer" value="Napisz Posta!"/>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        @endif
        <script>
            function textAreaAdjust(o)
            {
                o.style.height = "1px";
                o.style.height = (25+o.scrollHeight)+"px";
            }

            $(document).ready(function(){
                $('a#report').on('click', function(form)
                {
                    $('input[name="post"]').val($(this).attr('data-post'));
                });

                $('form.report').on('submit', function(form)
                {
                    form.preventDefault();
                    $('#reportModal').modal('hide')

                    $.ajax({
                       type: 'POST',
                        data: $('form.report').serialize(),
                        dataType: 'JSON',
                        url: '{{ route('reports.store') }}',
                        success: function(data)
                        {
                            $('body').append('<div class="alert alert-success flash_message" role="alert"><strong>Wykonano!</strong> Akcja została wykonana pomyślnie!</div>');
                        },
                        error: function(data)
                        {
                            $('body').append('<div class="alert alert-danger flash_message" role="alert"><strong>Błąd!</strong> Wykonujesz akcje na stronie zbyt często! Timeout wynosi: {{ config('app.throttle_action') }} minut.</div>');
                        }
                    });
                });


                $(document).on('click', 'button.post-edit', function(e){
                    e.preventDefault();
                    var col = $(this).closest('.row').find('.col-lg-10');
                    var old_from = col.find()
                    var old = col.find('.post-content').text().trim();

                    col.find('.post-content').hide();
                    col.find('.form').show();
                    col.find('textarea').val(old);

                    $(this).animate({
                        width: "0px",
                        height: "0px",
                        "font-size": "0px",
                    }, 1000);

                    $(this).fadeOut(500);
                });



                $(document).on('submit', '.post-update', function(e)
                {
                    e.preventDefault();
                    var col = $(this).closest('.row').find('.col-lg-10');

                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        data: $(this).serialize(),
                        url: '{{ route('temat.post.edit') }}',
                        success: function(data)
                        {
                            $('body').append('<div class="alert alert-success flash_message" role="alert"><strong>Wykonano!</strong> Akcja została wykonana pomyślnie!</div>');
                            col.html('<p>'+ data['post'] +'</p>');
                        },
                        error: function()
                        {
                            $('body').append('<div class="alert alert-danger flash_message" role="alert"><strong>Błąd!</strong> Prosimy o kontakt w celu jego wyjaśnienia!</div>');
                        }
                    });
                });




            });
        </script>
    </main>