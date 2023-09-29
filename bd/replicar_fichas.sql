-- inserir novas fichas em branco para os museus e em seguida rodar os códigos abaixo

-- detalhes fichas
update fichas as f
inner join fichas as f2 on f.museu = f2.museu and f2.indice = 1
set f.horario_funcionamento_administrativo  = f2.horario_funcionamento_administrativo,
	f.horario_atendimento_publico = f2.horario_atendimento_publico,
	f.telefone = f2.telefone,
	f.endereco = f2.endereco,
	f.situacao = f2.situacao ,
	f.observacoes = f2.observacoes,
	f.revisitacao = f2.revisitacao,
	f.visita_tecnica = f2.visita_tecnica
where f.indice = 2; --and f.museu = 1; -- testar em um museu

-- itens
insert into itens_fichas (ficha, tema, unidade_analise, unidade_contexto, categoria, sub_categoria, texto)
select f2.codigo as ficha, if1.tema, if1.unidade_analise , if1.unidade_contexto, if1.categoria, if1.sub_categoria, if1.texto  
from fichas f 
join fichas f2 on f.museu = f2.museu and f2.indice = 2
join itens_fichas if1 on f.codigo = if1.ficha 
where f.indice = 1;