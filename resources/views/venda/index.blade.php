@extends("templates.main")

@section("titulo", "Realizar Venda")

@section("formulario")
	<br/>
	<form action="/venda" method="POST" class="row">
		<div class="form-group col-6">
			<label>Cliente:</label>
			<select class="form-control" name="cliente" data-live-search="true">
				<option value=""></option>
				@foreach($clientes as $cliente)
					<option value="{{ $cliente->id }}">
						{{ $cliente->nome }}
					</option>
				@endforeach
			</select>
		</div>
	</form>
@endsection

@section("tabela")

@endsection