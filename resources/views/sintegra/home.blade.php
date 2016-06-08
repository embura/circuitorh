@extends('app')

@section('content')
<div class="container">
	<div class="row">

		<div class="col-xs-3 col-sm-3 col-md-3">
			<ul class="nav nav-pills nav-stacked">
				<li class="active"><a data-toggle="tab" href="#home">Pesquisa</a></li>
				<li><a data-toggle="tab" href="#menu1">Consulta</a></li>
			</ul>
			
		</div>

		<div class="col-xs-9 col-sm-9 col-md-9">
			<div class="tab-content">

				<div id="home" class="tab-pane fade in active">
					<h3>Pesquisa</h3>

				</div>

				<div id="menu1" class="tab-pane fade">
					<h3>Menu 1</h3>
					<p>Some content in menu 1.</p>
				</div>

				<div id="menu2" class="tab-pane fade">
					<h3>Menu 2</h3>
					<p>Some content in menu 2.</p>
				</div>

			</div>
		</div>

	</div>
</div>
@endsection
