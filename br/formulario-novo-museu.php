<?php
  include("cabecalho.php");
?>
        
        <div class="page-header">
          <h1>Cadastro de Museus</h1>
        </div>

<?php
  include("array_estados.php");
?>

        <form class="form-horizontal" action="adiciona-museu.php" method="get">
<!--  Museu -->
        <fieldset>

          <div class="form-group">
            <label for="indice" class="col-sm-2 control-label">Índice</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="indice" name="indice">
            </div>
          </div>

          <div class="form-group">
            <label for="nome" class="col-sm-2 control-label">Nome</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="nome" name="nome">
            </div>
          </div>

          <div class="form-group">
            <label for="uf" class="col-sm-2 control-label">Estado:</label>
            <div class="col-sm-10">
              <select class="form-control" name="uf" id="uf" onchange="buscar_cidades()">
                    <option value=""></option>
                <?php
                  foreach ($estados as $estado) {
                ?>
                    <option value="<?= $estado['sigla']?>"><?= $estado['nome'] ?></option>
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
              </select>
            </div>
          </div>

          <div class="form-group">

            <label for="ano_fundacao" class="col-sm-2 control-label">Fundação</label>
            <div class="col-sm-5">
              <input type="text" class="form-control" id="ano_fundacao" name="ano_fundacao" >
            </div>

            <div class="col-sm-5">
              <label>
                <input type="checkbox" id="sem_fundacao" name="sem_fundacao"> Sem fundação
              </label>
            </div>

          </div>
<!--
          <div class="form-group">
            <label for="horario_funcionamento_administrativo" class="col-sm-2 control-label">Horário do atendimento administrativo</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="horario_funcionamento_administrativo" name="horario_funcionamento_administrativo">
            </div>
          </div>

          <div class="form-group">
            <label for="horario_atendimento_publico" class="col-sm-2 control-label">Horário de atendimento ao público</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="horario_atendimento_publico" name="horario_atendimento_publico">
            </div>
          </div>

          <div class="form-group">
            <label for="telefone" class="col-sm-2 control-label">Telefone</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="telefone" name="telefone">
            </div>
          </div>

          <div class="form-group">
            <label for="endereco" class="col-sm-2 control-label">Endereço</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="endereco" name="endereco">
            </div>
          </div>

          <div class="form-group">
            <label for="situacao" class="col-sm-2 control-label">Situação</label>
            <div class="col-sm-10">
              <select class="form-control" name="situacao" id="situacao" />
                <option value="1">Ativo</option>
                <option value="2">Inativo</option>
              </select>
            </div>
          </div>
                -->
          <div class="form-group">
            <label for="periodo_pandemico" class="col-sm-2 control-label">Período Pandêmico:</label>
            <div class="col-sm-10">
              <textarea class="form-control" id="periodo_pandemico" name="periodo_pandemico"></textarea>
            </div>
          </div>
                
        </fieldset>

          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-default">Salvar</button>
            </div>
          </div>
          
        </form>

<?php include("rodape-formulario.php"); ?>