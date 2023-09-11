var checado=false;

$('categoria').find("input[name='categoria']").each(function(){
    if($(this).prop("checked"))
        checado=true;
});
if(!checado){
    alert("Deve ser selecionado uma opção entre Aprovado/Desaprovado!");
    return false;
}else {
	alert("checado = "+checado);
}

alert("ola");