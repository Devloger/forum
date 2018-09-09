		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<form action="{{ Route('login') }}" method="POST">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Logowanie</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
							<div class="form-group">
								<label for="login" class="form-control-label">Login:</label>
								<input type="text" class="form-control" name="login" id="login" />
							</div>
							<div class="form-group">
								<label for="password" class="form-control-label">Hasło:</label>
								<input type="password" class="form-control" name="password" id="password" />
							</div>
							{{ csrf_field() }}
					</div>
					<div class="modal-footer">
					<a href="#" class="text-primary mr-auto">Nie pamiętam hasła</a>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Wyjdź</button>
					<input type="submit" class="btn btn-primary" value="Zaloguj" />
					</div>
					</form>
				</div>
			</div>
		</div>
		<!--------------------------------------------------------------Report Modal----------------->
		<div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="reportModal" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<form class="report" action="{{ Route('reports.store') }}" method="POST">
						{{ csrf_field() }}
						{{ method_field('POST') }}
						<input type="hidden" name="post" value="" />
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Zgłoś Post</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label for="report_content" class="form-control-label">Proszę podać powód zgłoszenia:</label>
								<textarea type="text" class="form-control" name="report_content" onkeyup="textAreaAdjust(this)" required minlength="5" maxlength="255"></textarea>
							</div>
							<div class="form-group">
								<button type="submit" class="form-control btn-primary">Wyślij Zgłoszenie</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
@if(Session::has('login'))
	<div class="alert alert-danger flash_message" role="alert">
		<strong>Błąd!</strong> Nieprawidłowy login lub hasło!
	</div>
@endif
@if(Session::has('logged'))
	<div class="alert alert-success flash_message" role="alert">
		<strong>Zalogowano!</strong> Zostałeś zalogowany pomyślnie!
	</div>
@endif
@if(Session::has('mustlogin'))
	<div class="alert alert-danger flash_message" role="alert">
		<strong>Nie jesteś zalogowany!</strong> Musisz być zalogowany by wykonać tę akcję!
	</div>
@endif
@if(Session::has('Done'))
	<div class="alert alert-success flash_message" role="alert">
		<strong>Wykonano!</strong> Akcja została wykonana pomyślnie!
	</div>
@endif
@if(Session::has('throttle'))
	<div class="alert alert-danger flash_message" role="alert">
		<strong>Błąd!</strong> Wykonujesz akcje na stronie zbyt często! Timeout wynosi: {{ config('app.throttle_action') }} minut.
	</div>
@endif
@if(Session::has('logout'))
	<div class="alert alert-success flash_message" role="alert">
		<strong>Wylogowano!</strong> Zostałeś pomyślnie wylogowany!
	</div>
@endif
		<script>
            function textAreaAdjust(o)
            {
                o.style.height = "1px";
                o.style.height = (25+o.scrollHeight)+"px";
            }
		</script>