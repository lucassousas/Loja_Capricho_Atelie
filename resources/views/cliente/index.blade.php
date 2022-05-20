@extends("templates.main")

@section("title", "Clientes")

@section("formulario")
	<h1>Cadastro de Clientes</h1>
	<form action="/cliente" method="POST" class="row">
		<div class="form-group col-4">
			<label for="nome">Nome: </label>
			<input type="text" name="nome" class="form-control" value="{{ $cliente->nome }}" />
		</div>
		<div class="form-group col-5">
			<label for="cpf">CPF: </label>
			<input type="text" name="cpf" class="form-control" value="{{ $cliente->cpf }}" />
		</div>
		<div class="form-group col-3">
			@csrf
			<input type="hidden" name="id" value="{{ $cliente->id }}" />
			<a href="/cliente" class="btn btn-primary" style="margin-top: 23px;"><i class="bi bi-plus-square"></i> Novo</a>
			<button type="submit" class="btn btn-success" style="margin-top: 23px;"><i class="bi bi-save"></i> Salvar</button>
		</div>
	</form>
@endsection

@section("tabela")
	<br />
	<table class="table table-striped">
		<colgroup>
			<col width="100">
			<col width="200">
			<col width="80">
			<col width="80">
		</colgroup>
		<thead>
			<tr>
				<th>Nome</th>
				<th>CPF</th>
				<th>Editar</th>
				<th>Excluir</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($clientes as $cliente)
				<tr>
					<td>{{ $cliente->nome }}</td>
					<td>{{ $cliente->cpf }}</td>
					<td>
						<a href="/cliente/{{ $cliente->id }}/edit" class="btn btn-warning">Editar</a>
					</td>
					<td>
						<form method="POST" action="/cliente/{{ $cliente->id }}">
							@csrf
							<input type="hidden" name="_method" value="DELETE" />
							<button type="submit" onclick="return confirm('Deseja realmente excluir?');" class="btn btn-danger">Excluir</button>
						</form>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection