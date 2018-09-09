<body>
	<header>
		<nav class="navbar navbar-toggleable-md navbar-inverse bg-faded fixed-top">
		  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>
		  <a class="navbar-brand" href="{{ route('index') }}">Krystian Bogucki's Forum</a>
		  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
		    <div class="navbar-nav ml-auto">

				{{---------------------------------------------NIEZALOGOWANY--}}
				@if( ! auth()->check() )
				  <a class="nav-item nav-link" href="{{ route('uzytkownik.create') }}">Rejestracja</a>
				  <a class="nav-item nav-link" href="#" data-toggle="modal" data-target="#exampleModal">Logowanie</a>
                    <a class="nav-item nav-link" href="{{ route('strona.show', 'regulamin') }}">Regulamin</a>

				@else
					{{-----------------------------------------ZALOGOWANY--}}
					<a class="nav-item nav-link" href="{{ route('uzytkownik.show', auth()->user()->login) }}">Profil</a>
					<a class="nav-item nav-link" href="{{ route('uzytkownik.edit', auth()->user()) }}">Edycja Profilu</a>
					<a class="nav-item nav-link" href="{{ route('wiadomosci.index') }}">Wiadomości | <span class="{{ auth()->user()->inbox()->where('read', 0)->count() ? 'text-danger' : '' }}">{{ auth()->user()->inbox()->where('read', 0)->count() }}</span></a>
					<a class="nav-item nav-link" href="{{ route('logout') }}">Wyloguj</a>
				@endif
		    </div>
		  </div>
		</nav>
	</header>