@extends("templates.main")

@section("titulo", "Listagem de Vendas")

@section("tabela")
	<br/>
	<div class="row">
		<div class="form-group col-10">
			<input type="text" name="q" class="form-control" placeholder="Buscar..." />
		</div>
		<div class="form-group col-2">
			<a href="/venda/create" class="btn btn-primary" style="float: right;">
				<i class="bi bi-plus-square"> Nova Venda</i>
			</a>
		</div>
	</div>
	<br/>
	<table id="tabVendas" class="table table-striped">
		<colgroup>
			<col width="50">
			<col width="80">
			<col width="120">
			<col width="50">
			<col width="50">
			<col width="50">
		</colgroup>
		<thead>
			<tr>
				<th>Código</th>
				<th>Data</th>
				<th>Cliente</th>
				<th>Total</th>
				<th>Editar</th>
				<th>Cancelar</th>
			</tr>
		</thead>
		<tbody>
			@foreach($vendas as $venda)
				<tr>
					<td>{{ $venda->id }}</td>
					<td>{{ $venda->data }}</td>
					<td>{{ $venda->cliente }}</td>
					<td class="td_preco">{{ numberformat($venda->total, 2) }}</td>
					<td></td>
					<td></td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection

<script>
	document.addEventListener("DOMContentLoaded", function() {
		$(".td_preco").mask('#.##0,00', {reverse: true});
	});
</script>