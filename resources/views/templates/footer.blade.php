<footer>
	<div class="container">
		<div class="row bg-gray almost-footer">
			<div class="col-lg-6 p-3">
				<h6 class="text-gray">Ważne Linki</h6>
				<ul class="small list-unstyled pl-3">
					@foreach($pages as $page)
						<li><a href="{{ route('strona.show', $page->url) }}">{{ $page->name }}</a></li>
					@endforeach
				</ul>
			</div>
			<div class="col-lg-6 p-3 color-gray">
				<h6 class="mb-2">O forum</h6>
				<p class="small m-0 mb-2">{{ config('app.footer_description') }}</p>
				<hr class="nice-hr mb-2">
				<div class="row small text-center">
					<div class="col-lg">
						<i class="fa fa-comment-o" aria-hidden="true"></i> Posty: {{ $posts }}
					</div>
					<div class="col-lg">
						<i class="fa fa-comments-o" aria-hidden="true"></i> Tematy: {{ $topics }}
					</div>
					<div class="col-lg">
						<i class="fa fa-users" aria-hidden="true"></i> Użytkownicy: {{ $users }}
					</div>
				</div>
			</div>
		</div>
		<div class="row justify-content-between text-white small">
			<div class="col-lg p-0 text-left">
				<p>© {{ config('app.start_date') }}-{{ date('Y') }} {{ config('app.website') }}</p>
			</div>

			<div class="col-lg p-0 text-right p-margin0 color-gray">
				<p><a href="{{ route('index') }}">{{ str_replace('http://', '', url(''))  }}</a></p>
				<p>Community Software powered by BoguForum.</p>
			</div>
		</div>
	</div>
</footer>
</body>
</html>