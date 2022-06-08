@extends("templates.main")

@section("title", "Produtos")

@section("formulario")
	<h1>Cadastro de Produtos</h1>
	<form action="/produto" method="POST" class="row" onsubmit="carregaDados();">
		<div class="form-group col-4">
			<label for="descricao">Descrição: </label>
			<input type="text" name="descricao" class="form-control" value="{{ $produto->descricao }}" />
		</div>
		<div class="form-group col-5">
			<label for="preco">Preço: </label>
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text">R$</span>	
				</div>				
				<input type="text" id="preco_mask" name="preco_mask" class="form-control" placeholder="R$0,00" value="{{ ($produto->id == '') ? '' : number_format($produto->preco, 2) }}" />
				<input type="hidden" name="preco" id="preco" value="{{ $produto->preco }}" />
			</div>			
		</div>
		<div class="form-group col-3">
			@csrf
			<input type="hidden" name="id" value="{{ $produto->id }}" />
			<a href="/produto" class="btn btn-primary" style="margin-top: 23px;"><i class="bi bi-plus-square"></i> Novo</a>
			<button type="submit" class="btn btn-success" style="margin-top: 23px;"><i class="bi bi-save"></i> Salvar</button>
		</div>
	</form>
@endsection

@section("tabela")
	<div class="row">
		<div class="form-group col-12" style="margin-top: 50px;">
			<input type="text" id="q" placeholder="Pesquisar por descricao" class="form-control" onkeyup="buscar($(this).val());" />
		</div>
	</div>
	<table class="table table-striped" id="tabProd" style="margin-top: 10px;">
		<colgroup>
			<col width="200">
			<col width="200">
			<col width="100">
			<col width="100">
		</colgroup>
		<thead>
			<tr>
				<th>Descrição</th>
				<th>Preço</th>
				<th>Edit</th>
				<th>Del</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($produtos as $produto)
				<tr>
					<td class="td_descricao">{{ $produto->descricao }}</td>
					<td class="td_preco">{{ number_format($produto->preco, 2) }}</td>
					<td>
						<a href="/produto/{{ $produto->id }}/edit" class="btn btn-warning"><i class="bi bi-pencil-square"></i> Editar</a>
					</td>
					<td>
						<form method="POST" action="/produto/{{ $produto->id }}">
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
		$("#preco").val(parseFloat($("#preco_mask").cleanVal() / 100));
	}

	function buscar(q){

		q = q.toLowerCase();

		$("#tabProd tbody tr").each(function(){
			var mostrar = true;

			var descricao = $("td.td_descricao", this).html();
			descricao = descricao.toLowerCase();

			var preco = $("td.td_preco", this).cleanVal();

			mostrar = descricao.includes(q) || preco.includes(q);

			if(mostrar) {
				$(this).show();
			}else {
				$(this).hide();
			}
		});
	}

	document.addEventListener("DOMContentLoaded", function() {
		$("#preco_mask").mask("#.##0,00", {reverse: true});
		$(".td_preco").mask("#.##0,00", {reverse: true});
	});
</script>