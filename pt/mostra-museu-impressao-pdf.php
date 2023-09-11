<?php
	include ('mpdf60/mpdf.php');
	require_once 'class/conecta.php';
	require_once 'class/Museu.php';
	require_once 'class/Cidade.php';
	require_once 'class/Tema.php';
	require_once 'class/UnidadeAnalise.php';
	require_once 'class/UnidadeContexto.php';
	require_once 'class/CategoriaMuseu.php';
	require_once 'class/Categoria.php';

	$museu = new Museu($conexao);
	$cidade = new Cidade($conexao);
	$unidade_analise = new UnidadeAnalise($conexao);
	$unidade_contexto = new UnidadeContexto($conexao);
	$categoria_museu = new CategoriaMuseu($conexao);
	$categoria = new Categoria($conexao);

	$museu->setCodigo($_GET['codigo']);
	$m = $museu->buscar();

	$cidade->setCodCidade($m['cod_cidade']);
	$c = $cidade->buscaCidade();


	$tema = new Tema($conexao);
	$listagem_temas = $tema->listar();

	function listar_ua_por_tema($codigo_tema) {

		global $unidade_analise;
		$unidade_analise->setTema($codigo_tema);
		return $unidade_analise->listarPorTema();
	}

	function listar_uc_por_ua($codigo_ua) {
		global $unidade_contexto;
		$unidade_contexto->setUnidadeAnalise($codigo_ua);
		return $unidade_contexto->listarPorUnidadeAnalise();
	}

	function listar_categorias_por_museu($codigo_museu, $codigo_uc) {

		global $categoria_museu;
		$categoria_museu->setMuseu($codigo_museu);
		$categoria_museu->setUnidadeContexto($codigo_uc);
		return $categoria_museu->listarCategoriasPorUcMuseu();
	}

	function buscar_categoria($codigo_categoria) {
		global $categoria;
		$categoria->setCodigo($codigo_categoria);
		return $categoria->buscar();
	}

	function retornaSituacao ($situacao) {
		return $situacao == (1) ? "Ativo" : "Inativo";
	}

// MONTAGEM DO HTML ESTÁTICO
	$pagina = 
		"<html lang=\'pt-br\'>
			<head>
				<meta charset=\"utf-8\">
			</head>
			<body>
			<div class=\"container\">
		        <div>
		          <h1 class=\"impressao\">Informações pesquisadas sobre o Museu</h1>
		        </div>

				<table class=\"table\">
					<tr>
						<th>Código</th>
						<td>". $m['codigo'] ."</td>
					</tr>
					<tr>
						<th>Nome</th>
						<td>". $m['nome'] ."</td>
					</tr>
					<tr>
						<th>Ano de fundação</th>
						<td>". $m['ano_fundacao'] ."</td>
					</tr>
					<tr>
						<th>Atendimento Administrativo</th>
						<td>". $m['horario_funcionamento_administrativo'] ."</td>
					</tr>
					<tr>
						<th>Atendimento ao público</th>
						<td>". $m['horario_atendimento_publico'] ."</td>
					</tr>
					<tr>
						<th>Contacto</th>
						<td>". $m['telefone'] ."</td>
					</tr>
					<tr>
						<th>Concelho</th>
						<td>". $c['nome'] ."</td>
					</tr>
					<tr>
						<th>Morada</th>
						<td>". $m['endereco'] ."</td>
					</tr>
					<tr>
						<th>Situação</th>
						<td>". retornaSituacao($m['situacao']) ."</td>
					</tr>
					<tr>
						<th>Observações</th>
						<td class=\"text-justify\">". $m['observacoes'] ."</td>
					</tr>
				</table>";

	//MONTAGEM DO HTML DINAMICO

	foreach ($listagem_temas as $t) { //PERCORRE TEMAS
		$ficha .= "<h1 class=\"text-warning\">". $t['letra'] ." - ". $t['descricao'] ."</h1>";

		$listagem_ua_por_tema = listar_ua_por_tema($t['codigo']);

		foreach ($listagem_ua_por_tema as $ua) { //PERCORRE UNIDADES DE ANALISES
			$ficha .= "<h2 class=\"text-info\">". $ua['num_romano'] ." - ". $ua['descricao'] ."</h2>";

			$listagem_uc_por_ua = listar_uc_por_ua($ua['codigo']);

			foreach ($listagem_uc_por_ua as $uc) { // PERCORRE UNIDADES DE CONTEXTO
				$texto_uc = $uc['num_cardinal']." - ".$uc['descricao'];
				//remover numero romano da unidade de contexto - Se igual a zero ( 0 )
				if ($uc['num_cardinal'] == 0){
					$texto_uc = $uc['descricao'];
				}
				//<!-- UNIDADES DE CONTEXTOS -->
				$ficha .= "<h3>". $texto_uc ."</h3>";

				//<!-- CATEGORIAS -->
				$ficha .= "<ul class=\"list-inline text-left\">";

				//$ficha.= "<p>" . $m['codigo'] . "</p>";
				//$ficha.= "<p>" . $uc['codigo'] . "</p>";

				$listagem_categorias_museu = listar_categorias_por_museu($m['codigo'], $uc['codigo']);

				foreach ($listagem_categorias_museu as $cm) {
					$cat = buscar_categoria($cm['categoria']);
					if($cat['tipo_categoria'] == 1) {
						$ficha.= "<li>" . $cat['descricao'] . "</li>";
					}
				}

				foreach ($listagem_categorias_museu as $cm) {
					$cat = buscar_categoria($cm['categoria']);
					if($cat['tipo_categoria'] == 4) {
						$ficha.= "<li><strong>" . $cat['descricao'] . "</strong></li>";

						foreach ($listagem_subcategorias_museu as $scm) {
							
						}

					}
				}

				foreach ($listagem_categorias_museu as $cm) {
					$cat = buscar_categoria($cm['categoria']);
					if($cat['tipo_categoria'] == 2) {
						$ficha.= "<li><strong>" . $cat['descricao'] . ": </strong></li>";
					}
				}

				$ficha .= "</ul>";

			}
		}

	}


	if ($m['situacao'] == (1)) { // MOSTRA TODA FICHA ABAIXO
		$pagina = $pagina . $ficha;
	}

	//FECHAMENTO DO HTML DINAMICO
	$pagina = $pagina."
			</div>
			</body>
		</html>";

// FIM MONTAGEM HTML

	$arquivo = "ficha-museu-".$codigo.".pdf";

	//criar o objeto
	$mpdf = new mPDF();

	$mpdf->allow_charset_conversion = true;

	$mpdf->charset_in = 'UTF-8';

	$bootstrap = file_get_contents('dist/css/bootstrap.min.css');
	$css = file_get_contents('css/starter-template.css');

	//$mpdf->SetHeader('TITULO NOVO|Center Text|{PAGENO}');
	$mpdf->SetFooter('PÁGINA {PAGENO} DE {nbpg}');

	$mpdf->writeHTML($bootstrap, 1);
	$mpdf->writeHTML($css, 1);
	$mpdf->writeHTML($pagina,2);

	$mpdf->Output($arquivo, 'I');

	//exit();

	// I - Abre no navegador
	// F - Salva o arquivo no servidor
	// D - Salva o arquivo no computador do usuario

?>