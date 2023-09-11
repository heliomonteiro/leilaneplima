<?php include("cabecalho.php");

/* --------- IMPRIME ITENS DINAMICAMENTE PASSANDO TABELA
	require_once 'class/Conecta.php';
 	require_once 'class/Item.php';

 	$item = new Item($conexao);
 	$itens = $item->listaItens('tipologias_acervos');

 	foreach ($itens as $i) {
 		echo $i['codigo']." - ".$i['descricao']."<br>";
 	}
*/

/* ---------  IMPRIME SELECTS PREENCHIDOS COM ITENS -----------------------------------------------
 	require_once 'class/CampoFormulario.php';

 	$campo = new CampoFormulario;
 	$campo->Select('Categoria Institucional','categoria_institucional','categorias_institucionais');
 	$campo->Select('Natureza Administrativa','natureza_administrativa','naturezas_administrativas');
 	$campo->Select('Tipologia Acervo','tipologia_acervo','tipologias_acervos');
 */

 	//require_once 'class/Conecta.php';
 	require_once 'class/CampoFormulario.php';
 /*	require_once 'class/Tematica.php';

 	$tematica = new Tematica($conexao);
 	$tematicas = $tematica->listaTematicas('identidades_museus');
  	foreach ($tematicas as $t) {
 		echo $t['museu']." - ".$t['categoria_institucional']."<br>";
 	}*/

/* ------------------------ CARREGA CATEGORIAS EM CHECKBOXES ----------------------------------
 	require_once 'class/Categoria.php';
 	$categoria = new Categoria($conexao);
 	$categoria->setUnidadeContexto(1);
 	$categorias = $categoria->listarPorUnidadeContexto();
?>
	<form action="adiciona-categorias-museu.php" method="get">
<?php
 	foreach ($categorias as $cat) {
?>

  <label class="checkbox-inline">
    <input type="checkbox" name="categoria[]" value="<?= $cat['codigo'] ?>">
   	<?= $cat['descricao'] ?>
  </label>
<?php
 	}
?>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-default">Salvar</button>
        </div>
      </div>
    </form>
*/

    $campo = new CampoFormulario();
    $campo->SelectAll("Tema","tema");
?>
	<div id="listar_unidades_analises">
		<?php
		    $campo->SelectPorParam ("Unidade de Análise", "unidade_analise", "unidades_analises", 1,"buscar_cidades");
		?>
	</div>
<?php 
    //$campo->SelectPorParam ("Unidade de Contexto", "unidade_contexto", "unidades_contextos", 1);
include("rodape-formulario.php")
?>