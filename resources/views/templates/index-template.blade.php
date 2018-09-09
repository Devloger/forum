			{{--<div class="bluer">--}}
				{{--<a href="#">Najnowszy news: #98 Tygodnik MPC News - O grach MMORPG słów kilka! @yield('post')</a>--}}
			{{--</div>--}}
			<div class="row">
				<div class="col-lg-9">
				@foreach($categories as $category)
					<div class="row section-bluer">
						<div class="col-lg-12">
							<div class="bluer">
								{{ $category->name }}
							</div>
						</div>
					</div>
				{{----------------------------------------------------------------------------------------------Sekcja lewa --}}
					@foreach($sections as $section)
						@if( $section->category === $category->id )
						<div class="row section-first">
							<div class="col-lg-1 section-picture my-auto">
								<img src="{{ asset(config('app.avatars_sections').$section->section_avatar) }}" style="width: 45px; height: 45px" />
							</div>
							<div class="col-lg-8 section-this my-auto">
								<h4><a href="{{ route('sekcja.show', $section->section_url) }}">{{ str_limit($section->name, 50) }}</a></h4>
								<p>{{ $section->description }}</p>
								<hr>
								@foreach( $sections as $section2 )
									@if( $section2->parent === $section->id )
										<a href="{{ route('sekcja.show', $section2->url) }}">{{ $section2->name }}</a>
									@endif
								@endforeach
							</div>
				{{-------------------------------------------------------------------------------------------------Sekcja prawa --}}
							<div class="col-lg-1 section-count text-center my-auto small-text">
								<b>{{ $topics_count->where('id', $section->id)->first()['count'] }}</b> tematy<br>
								<b>{{ $posts_count->where('id', $section->id)->first()['count'] }}</b> postów
							</div>
							<div class="col-lg-2 section-last-post my-auto">
								<div class="row">
									<div class="col-lg-4 my-auto last-topic-img d-flex justify-content-lg-end justify-content-center">
										<img src="{{ asset(config('app.avatars').$section->user_avatar) }}" style="width: 32px; height: 32px" />
									</div>
									<div class="col-lg-8 small-text last-topic my-auto text-center">
										<p><a href="{{ route('temat.show', $section->topic_url) }}">{{ str_limit($section->topic_name, 30) }}</a></p>
										<p><a href="{{ route('uzytkownik.show', $section->login) }}">Przez {{ $section->login }}</a></p>
										<p>{{ $section->date }}</p>
									</div>
								</div>
							</div>
						</div>
						<hr class="nice-hr">
					@endif
				@endforeach
			@endforeach
			{{-------------------------------------------------------------------------------------------------Koniec 1 kategorii --}}
				<div class="margin-bottom-small"></div>
					<!------------------------------------------Forum Onliners..... NOT ANYMORE --->
				</div>
				<aside class="col-lg-3 pl-lg-0">
					<div class="row abox">
					{{-------------------------------------------------------------------------------------------------Reklama --}}
						Reklama
					</div>
					{{-------------------------------------------------------------------------------------------------Popularni autorzy --}}
					<div class="row abox">
						Popularni Autorzy
					</div>
					<?php $x=0; ?>
					@foreach( $top_reputations as $top_reputation )
						@if( $top_reputation->reputation >= config('app.top_users_minimum') )
							<div class="row text-center popular-autors clearfix" >
								<div class="col-xl-1 my-auto">
									<p>{{ ++$x }}</p>
								</div>
								<div class="col-xl-2 my-auto">
									<a href="#"><img src="{{ config('app.avatars').$top_reputation->avatar }}" style="width: 29px; height: auto;" /></a>
								</div>
								<div class="col-xl-8 my-auto">
									<a href="{{ route('uzytkownik.show', $top_reputation->author) }}"><p>{{ $top_reputation->author }}</p></a>
									<p><span class="badge badge-pill badge-success"><i class="fa fa-plus-square" aria-hidden="true"></i> {{ $top_reputation->reputation }}</span></p>
								</div>
							</div>
						@endif
					@endforeach
					{{-------------------------------------------------------------------------------------------------Ostatnie Posty --}}
					<div class="row abox">
						Ostatnie Posty
					</div>
					@foreach($last_posts as $last_post)
					<div class="row last-posts mb-4">
						<div class="col-lg-2 my-auto text-center">
							<a href="#"><img src="{{ config('app.avatars').$last_post->avatar }}" style="width: 29px; height: auto;" /></a>
						</div>
						<div class="col-lg-10 my-auto">
							<p><a href="{{ route('uzytkownik.show', $last_post->author) }}">{{ $last_post->author }}</a> <span class="float-right">{{ $last_post->date }}</span></p>
							<p><a href="{{ route('temat.show', $last_post->url) }}">{{ str_limit($last_post->content, 110) }}</a></p>
						</div>
					</div>
					@endforeach
				</aside>
			</div>
		</main>