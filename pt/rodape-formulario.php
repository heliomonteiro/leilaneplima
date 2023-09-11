       </div><!-- /.starter-template

    </div><!-- /.container -->

    <!-- jQuery (obrigatório para plugins JavaScript do Bootstrap) -->
     <script src="assets/js/vendor/jquery.min.js"></script>
    <!-- Inclui todos os plugins compilados (abaixo), ou inclua arquivos separadados se necessário -->
    <script type="text/javascript" src="dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="dist/js/jquery.mask.min.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>

    <script type="text/javascript" src="js/formulario-novo-museu.js"></script>
    <script type="text/javascript" src="js/formulario-ficha.js"></script>
    <script type="text/javascript" src="js/ajax_buscar_cidades.js"></script>


    <script type="text/javascript">
      
    $(document).ready(function(){


        var sem_fundacao = false;

       //alert("oi");

        $("#sem_fundacao").click(function(){

            if($(this).is(':checked'))
              //alert("CheckBox marcado.");
              $("#ano_fundacao").prop( "readonly", true );
            else
              //alert("CheckBox desmarcado.");
              $("#ano_fundacao").prop( "readonly", false );

        });
    });

    </script>

  </body>
</html>