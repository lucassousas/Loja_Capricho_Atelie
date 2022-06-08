@extends("templates.main")

@section("titulo", "Realizar Venda")

@section("formulario")
	<br/>
	<form action="/venda" method="POST" class="row">
		<div class="form-group col-6">
			<label>Cliente:</label>
			<select class="form-control selectpicker" name="cliente_id" data-live-search="true">
				<option value=""></option>
				@foreach($clientes as $cliente)
					<option value="{{ $cliente->id }}" @selected($venda->cliente_id == $cliente->id)>
						{{ $cliente->nome }}
					</option>
				@endforeach
			</select>
		</div>
		<div class="form-group col-6">
			@csrf
			<input type="hidden" name="id" value="{{ $venda->id }}" />
			<button type="submit" class="btn btn-success" style="margin-top: 25px;">
				<i class="bi bi-save"></i> Salvar
			</button>
			@if($venda->id != "")
				<a href="/venda/{{$venda->id}}/item" class="btn btn-primary" style="margin-top: 25px;">
					<i class="bi bi-plus-square"></i> Adicionar Item
				</a>
			@endif
		</div>
	</form>
@endsection

@section("tabela")
	
@endsection