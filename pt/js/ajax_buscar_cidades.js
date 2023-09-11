    function buscar_cidades(){
        var uf = $('#uf').val();
        if(uf) {
            var url = 'ajax_buscar_cidades.php?uf='+uf;
            $.get(url, function (dataReturn) {
                $('#listar_cidades').html(dataReturn);
            });
        }
    }