<?php
  include("cabecalho.php");
  require_once ("class/Conecta.php");
  require_once ("class/Cidade.php");
  require_once ("class/Museu.php");
?>
        
        <div class="page-header">
          <h1>Cadastro de Museus</h1>
        </div>

<?php
  $estados = array(
    1=>array("sigla"=>"AC","nome"=>"Acre"),
    2=>array("sigla"=>"AL","nome"=>"Alagoas"),
    3=>array("sigla"=>"AM","nome"=>"Amazonas"),
    4=>array("sigla"=>"AP","nome"=>"Amapá"),
    5=>array("sigla"=>"BA","nome"=>"Bahia"),
    6=>array("sigla"=>"CE","nome"=>"Ceará"),
    7=>array("sigla"=>"DF","nome"=>"Distrito Federal"),
    8=>array("sigla"=>"ES","nome"=>"Espírito Santo"),
    9=>array("sigla"=>"GO","nome"=>"Goiás"),
    10=>array("sigla"=>"MA","nome"=>"Maranhão"),
    11=>array("sigla"=>"MT","nome"=>"Mato Grosso"),
    11=>array("sigla"=>"MS","nome"=>"Mato Grosso do Sul"),
    13=>array("sigla"=>"MG","nome"=>"Minas Gerais"),
    14=>array("sigla"=>"PA","nome"=>"Pará"),
    15=>array("sigla"=>"PB","nome"=>"Paraiba"),
    16=>array("sigla"=>"PR","nome"=>"Paraná"),
    17=>array("sigla"=>"PE","nome"=>"Pernambuco"),
    18=>array("sigla"=>"PI","nome"=>"Piauí"),
    19=>array("sigla"=>"RJ","nome"=>"Rio de Janeiro"),
    20=>array("sigla"=>"RN","nome"=>"Rio Grande do Norte"),
    21=>array("sigla"=>"RO","nome"=>"Rondônia"),
    22=>array("sigla"=>"RS","nome"=>"Rio Grande do Sul"),
    23=>array("sigla"=>"RR","nome"=>"Roraima"),
    24=>array("sigla"=>"SC","nome"=>"Santa Catarina"),
    25=>array("sigla"=>"SE","nome"=>"Sergipe"),
    26=>array("sigla"=>"SP","nome"=>"São Paulo"),
    27=>array("sigla"=>"TO","nome"=>"Tocantins")
  );

  $codigo = $_GET['museu'];

  $museu = new Museu($conexao);
  $museu->setCodigo($codigo);
  $m = $museu->buscar();

  $cidade = new Cidade($conexao);
  $cidade->setCodCidade($m['cod_cidade']);
  $c = $cidade->buscaCidade();

?>

        <form class="form-horizontal" action="altera-museu.php" method="post">

          <div class="form-group">
            <label for="nome" class="col-sm-2 control-label">Índice</label>
            <div class="col-sm-4">
              <input type="number" class="form-control" id="indice" name="indice" value="<?= $m['indice'] ?>">
            </div>

            <label for="nome" class="col-sm-2 control-label">Código</label>
            <div class="col-sm-4">
              <input type="number" class="form-control" id="codigo" name="codigo" value="<?= $m['codigo'] ?>" readonly>
            </div>
          </div>

          <div class="form-group">
            <label for="nome" class="col-sm-2 control-label">Nome</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="nome" name="nome" value="<?= $m['nome'] ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="uf" class="col-sm-2 control-label">Estado:</label>
            <div class="col-sm-10">
              <select class="form-control" name="uf" id="uf" onchange="buscar_cidades()">
                    <option value=""></option>
                <?php

                  $estado = $c['uf'];

                  foreach ($estados as $estado) {
                ?>
                    <option value="<?= $estado['sigla']?>" <?= ($estado['sigla'] == $c['uf']) ? 'selected' : ''?> > <?= $estado['nome'] ?> </option>
                <?php
                  }
                ?>
              </select>
            </div>
          </div>

          <div class="form-group" id="listar_cidades">
            <label for="cod_cidade" class="col-sm-2 control-label">Cidade:</label>
            <div class="col-sm-10">
              <select class="form-control" name="cod_cidade" id="cod_cidade"/>
                    <option value="">Escolha um estado</option>
                    <?php
                       $cidade->setUf($c['uf']);
                       $cidades = $cidade->buscaCidadesPorEstado();
                       foreach ($cidades as $cs) {
                       ?>
                          <option value="<?= $cs['cod_cidade'] ?>" <?= ($c['cod_cidade'] == $cs['cod_cidade']) ? 'selected' : ''?> > <?= $cs['nome'] ?> </option>
                       <?php
                       }
                     ?>
              </select>
            </div>
          </div>

          <div class="form-group">

            <label for="ano_fundacao" class="col-sm-2 control-label">Fundação</label>
            <div class="col-sm-5">
              <input type="text" class="form-control" id="ano_fundacao" name="ano_fundacao" value="<?= $m['ano_fundacao'] ?>">
            </div>

            <div class="col-sm-5">
              <label>
                <input type="checkbox" id="sem_fundacao" name="sem_fundacao" value=""> Sem fundação
              </label>
            </div>

          </div>
<!--
          <div class="form-group">
            <label for="horario_funcionamento_administrativo" class="col-sm-2 control-label">Horário do atendimento administrativo</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="horario_funcionamento_administrativo" name="horario_funcionamento_administrativo" value="<?= $m['horario_funcionamento_administrativo'] ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="horario_atendimento_publico" class="col-sm-2 control-label">Horário de atendimento ao público</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="horario_atendimento_publico" name="horario_atendimento_publico" value="<?= $m['horario_atendimento_publico'] ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="telefone" class="col-sm-2 control-label">Telefone</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="telefone" name="telefone" value="<?= $m['telefone'] ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="endereco" class="col-sm-2 control-label">Endereço</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="endereco" name="endereco" value="<?= $m['endereco'] ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="situacao" class="col-sm-2 control-label">Situação</label>
            <div class="col-sm-10">
              <select class="form-control" name="situacao" id="situacao" />
                <option value="1" <?= ($m['situacao'] == 1) ? 'selected' : ''?> >Ativo</option>
                <option value="2" <?= ($m['situacao'] == 2) ? 'selected' : ''?> >Inativo</option>
              </select>
            </div>
          </div>
                      -->
          <div class="form-group">
            <label for="periodo_pandemico" class="col-sm-2 control-label">Período Pandêmico:</label>
            <div class="col-sm-10">
              <textarea class="form-control" id="periodo_pandemico" name="periodo_pandemico" rows="5"><?= $m['periodo_pandemico'] ?></textarea>
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-default">Salvar</button>
            </div>
          </div>
          
        </form>

        <!-- tem js -->

<?php include("rodape-formulario.php"); ?>