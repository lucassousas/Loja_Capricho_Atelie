@extends("templates.main")

@section("title", "Produtos")

@section("formulario")
	<form action="/produto" method="POST" class="row">
		<div class="form-group col-5">
			<label for="descricao">Descrição</label>
			<input type="text" name="descricao" class="form-control" value="{{ $produto->descricao }}" />
		</div>
		<div class="form-group col-5">
			<label for="preco">Preço</label>
			<input type="decimal" name="preco" class="form-control" value="{{ $produto->preco }}" />
		</div>
	</form>
@endsection