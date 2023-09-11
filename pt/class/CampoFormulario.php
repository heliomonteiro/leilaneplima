<?php

Class CampoFormulario {

		private $tema;
		private $unidade_analise;
		private $unidade_contexto;
		private $categoria;
		private $sub_categoria;

	function __construct() {
		require_once 'class/Conecta.php';
		require_once 'class/Tema.php';
		require_once 'class/UnidadeAnalise.php';
		require_once 'class/UnidadeContexto.php';
		require_once 'class/Categoria.php';
		$this->tema = new Tema($conexao);
		$this->unidade_analise = new UnidadeAnalise($conexao);
		$this->unidade_contexto = new UnidadeContexto($conexao);
		$this->categoria = new Categoria($conexao);
	}
	
	function Input ($tipo, $nome, $classe, $label) {
		echo '<p><input type="'.$tipo.'" name="'.$nome.'" class="'.$classe.'" /></p>';
	}

	function SelectAll ($label, $nome) {

		echo '          <div class="form-group">';
		echo '            <label for="'.$nome.'" class="col-sm-2 control-label">'.$label.'</label>';
		echo '            <div class="col-sm-10">';
		echo '              <select class="form-control" name="'.$nome.'" id="'.$nome.'" onchange="buscar_unidades_analises() >';	
		$temas = $this->tema->listar();
		foreach ($temas as $t) {
				echo '<option value="'.$t['codigo'].'">'.$t['descricao']."</option>";
		}
		echo '              </select>';
		echo '            </div>';
		echo '          </div>';

	}

	function SelectPorParam ($label, $nome, $tabela, $parametro, $onchange) {

		$itens;
		if ($tabela == "unidades_contextos") {
			$this->unidade_contexto->setUnidadeAnalise($parametro);
			$itens = $this->unidade_contexto->listarPorUnidadeAnalise();
		}

		if ($tabela == "unidades_analises") {
			$this->unidade_analise->setTema($parametro);
			$itens = $this->unidade_analise->listarPorTema();
		}

		echo '          <div class="form-group" id="listar_unidades_analises">';
		echo '            <label for="'.$nome.'" class="col-sm-2 control-label">'.$label.'</label>';
		echo '            <div class="col-sm-10">';
		echo '              <select class="form-control" name="'.$nome.'" id="'.$nome.'" onchange="<?= $onchange ?>()/>';	
		foreach ($itens as $i) {
				echo '<option value="'.$i['codigo'].'">'.$i['descricao']."</option>";
		}
		echo '              </select>';
		echo '            </div>';
		echo '          </div>';

	}
}