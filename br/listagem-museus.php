<?php include("cabecalho.php");
	  require_once 'class/Conecta.php';
	  require_once 'class/Cidade.php';
	  require_once 'class/Museu.php';
?>

        <div class="page-header">
          <h1>Listagem de Museus</h1>
        </div>

<?php
	$museu = new Museu($conexao);
	$cidade = new Cidade($conexao);
	$museus = $museu->listar();
?>

	<table class="table table-striped">
	<thead>
		<tr>
			<th>índice</th>
			<th>Código do Museu</th>
			<th>Nome</th>
			<th>Ano de Fundação</th>
			<th>Cidade - UF</th>
			<th colspan="3">Museu</th>
			<th colspan="4">Fichas</th>
			<th colspan="2">Imagens</th>
		</tr>
	</thead>
	<tbody>
<?php
	foreach ($museus as $m) {
	$cidade->setCodCidade($m['cod_cidade']);
	$c = $cidade->buscaCidade();
	$museu->setCodigo($m['codigo']);
	$qtd_fichas = $museu->buscarQtdFichas();
	//var_dump($qtd_fichas['qtd_fichas']);
?>
		<tr>
			<td><label class="label alert-info"> <?= $m['indice'] ?> </label></td>
			<td><?= $m['codigo'] ?></td>
			<td><?= $m['nome'] ?> (<?= $qtd_fichas['qtd_fichas'] ?>)</td>
			<?php
				$data_fundacao = $m['ano_fundacao'];
				//$data_fundacao = date('Y',strtotime($data_fundacao));
				if ($m['sem_fundacao'] == true)
					$data_fundacao = 'S/D';
			?>
			<td><?= $data_fundacao ?></td>
			<td><?= $c['nome'] .' - '. $c['uf']?></td>

			<td><a href="formulario-altera-museu.php?museu=<?=$m['codigo']?>" title="Alterar museu"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>
			<td><a onclick="confirmaDelecao('<?= $m['codigo'] ?>','<?= $m['nome'] ?>')" href="javascript:func()" title="Deletar museu"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></td>
			<td></td>

			<td><a href="formulario-ficha.php?museu=<?=$m['codigo']?>" title="Preencher ficha do museu"><span class="glyphicon glyphicon-edit text-info" aria-hidden="true"></span></a></td>
			<td><a href="mostra-museu.php?codigo=<?=$m['codigo']?>" title="Visualizar ficha do museu"><span class="glyphicon glyphicon-eye-open text-info" aria-hidden="true"></span></a></td>
			<td><a href="mostra-museu-impressao.php?codigo=<?=$m['codigo']?>" title="Visualizar ficha do museu para impressão" target="_blank"><span class="glyphicon glyphicon-print text-info" aria-hidden="true"></span></a></td>
			<td></td>

			<td><a href="envia-imagens.php?codigo=<?=$m['codigo']?>" title="Enviar imagens do museu"><span class="glyphicon glyphicon-camera" aria-hidden="true"></span></a></td>
			<td><a href="deleta-imagens-museu.php?codigo=<?=$m['codigo']?>" title="Deletar imagens do museu"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></td>

		</tr>
<?php
	}
?>	
	</tbody>
	</table>

	<script type="text/javascript">
		function confirmaDelecao(id,nome) {
			var resposta = confirm("Deseja excluir este museu: "+id+" - "+nome+"?\n\n Obs.: Serão apagados o museu, sua ficha e imagens.");
			if (resposta == true) {
				window.location.href="deleta-museu.php?codigo="+id;
			}
		}
	</script>

<?php include("rodape.php"); ?>