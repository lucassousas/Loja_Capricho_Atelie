@extends("templates.main")

@section("title", "Clientes")

@section("formulario")
	<h1>Cadastro de Clientes</h1>
	<form action="/cliente" method="POST" class="row" onsubmit="carregaDados();">
		<div class="form-group col-4">
			<label for="nome">Nome: </label>
			<input type="text" name="nome" class="form-control" value="{{ $cliente->nome }}" />
		</div>
		<div class="form-group col-5">
			<label for="cpf">CPF: </label>
			<input type="text" id="cpf_mask" name="cpf_mask" class="form-control" value="{{ $cliente->cpf }}" />
			<input type="hidden" name="cpf" id="cpf" value="{{ $cliente->cpf }}" />
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
	<div class="row">
		<div class="form-group col-12" style="margin-top: 50px;">
			<input type="text" id="q" placeholder="Pesquisar por nome" class="form-control" onkeyup="buscar($(this).val());" />
		</div>
	</div>
	<table class="table table-striped" id="tabCli" style="margin-top: 10px;">
		<colgroup>
			<col width="200">
			<col width="200">
			<col width="100">
			<col width="100">
		</colgroup>
		<thead>
			<tr>
				<th>Nome</th>
				<th>CPF</th>
				<th>Edit</th>
				<th>Del</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($clientes as $cliente)
				<tr>
					<td class="td_nome">{{ $cliente->nome }}</td>
					<td class="td_cpf">{{ $cliente->cpf }}</td>
					<td>
						<a href="/cliente/{{ $cliente->id }}/edit" class="btn btn-warning"><i class="bi bi-pencil-square"></i> Editar</a>
					</td>
					<td>
						<form method="POST" action="/cliente/{{ $cliente->id }}">
							@csrf
							<input type="hidden" name="_method" value="DELETE" />
							<button type="submit" onclick="return confirm('Deseja realmente excluir?');" class="btn btn-danger"><i class="bi bi-trash"></i> Excluir</button>
						</form>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection

<script>
	function carregaDados(){
		$("#cpf").val($("#cpf_mask").cleanVal());
	}

	function buscar(q){

		q = q.toLowerCase();

		$("#tabCli tbody tr").each(function(){
			var mostrar = true;

			var nome = $("td.td_nome", this).html();
			nome = nome.toLowerCase();

			var cpf = $("td.td_cpf", this).cleanVal();

			mostrar = nome.includes(q) || cpf.includes(q);

			if(mostrar) {
				$(this).show();
			}else {
				$(this).hide();
			}
		});
	}

	document.addEventListener("DOMContentLoaded", function() {
		$("#cpf_mask").mask("000.000.000-00", {"placeholder": "___.___.___-__"});

		$(".td_cpf").mask("000.000.000-00");
	});
</script>