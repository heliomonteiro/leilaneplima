create table fichas (
	codigo integer not null auto_increment,
	museu integer,
	data_cadastro date default current_date(),
	revisitacao boolean default false,
	primary key (codigo),
	foreign key (museu) references museus(codigo)
)
;

/* 		alteraÁıes MUSEUS e CATEGORIAS_MUSEUS -> FICHAS e ITENS FICHAS			*/
-- 1 - Renomear tabela categorias_museus P/ itens_fichas
-- 2 - Renomear Tabela Museus P/Fichas
-- 3 - remover vinculo itens_fichas C/ Museus
-- 4 - renomear coluna museu para ficha
-- 5 - atualizar vinculo itens_fichas C/ Fichas
-- obs. n„o precisaria remover a constraint entre categorias_museus e museus - apenas renomear as duas tabelas (museus > fichas e categorias_museus > itens_fichas)
/*		Nova Tabela Museus		*/
-- 6 - Duplicar tabela itens_fichas > nova tabela museus. Ao duplicar, j· teremos replicado o cÛdigo do museu entre a ficha e museus, bastando linkar depois.
-- 7 - Na tabela museus - manter apenas colunas codigo, nome e fundacao.
-- 8 - Na tabela fichas - manter demais colunas que podem ser modificadas removendo nome e fundacao. Incluir data visita tecnica.
-- 9 - Criar vinculo entre fichas e museu
-- 10 - criar vinculo ficha com cidade e situacao
-- 11 - atualizar indice das fichas para 1, visto que todas iniciaram em 1 pra cada museu. E hoje temos apenas uma por museu. Definir default 1.

-- 1
rename table categorias_museus to itens_fichas;
-- 2
rename table museus to fichas;
-- 3
ALTER TABLE itens_fichas
	DROP FOREIGN KEY itens_fichas_ibfk_1;
-- 4
alter table itens_fichas
	change museu ficha integer;
-- 5
alter table itens_fichas 
	add constraint fk_itens_fichas_ficha
	foreign key (ficha)
	references fichas(codigo);
-- 6
create table museus
	select * from fichas;
alter table museus 
	modify codigo int not null auto_increment primary key;
select * from fichas;
select * from museus;
-- 7 
select * from museus;
alter table museus
	drop column horario_funcionamento_administrativo, 
	drop column horario_atendimento_publico, 
	drop column telefone, 
	drop column cod_cidade, 
	drop column endereco, 
	drop column situacao, 
	drop column observacoes;
select * from museus;
-- 8
select * from fichas;
alter table fichas 
	drop column nome, 
	drop column ano_fundacao, 
	drop column sem_fundacao;
alter table fichas
	add column revisitacao boolean default(false),
	add column visita_tecnica date;
select * from fichas;
-- 9
select * from fichas;
alter table fichas 
	add column museu integer;
alter table fichas 
	add constraint fk_fichas_museu
	foreign key (museu)
	references museus(codigo);
-- 10
select * from fichas;
alter table fichas 
	add constraint fk_fichas_situacao
	foreign key (situacao)
	references situacoes(cod_situacao);
alter table fichas 
	add constraint fk_fichas_cidade
	foreign key (cod_cidade)
	references cidades(cod_cidade);
select * from imagens_museus im ;
alter table imagens_museus
	add constraint fk_imagens_museus_museu
	foreign key (codigo_museu)
	references museus(codigo);
-- 11
select * from fichas;
alter table fichas 
	modify column indice int default(1);
update fichas 
	set indice = 1;
update fichas 
	set museu = codigo;
	
--
select m.*, cod_cidade from museus m
left join fichas f on m.codigo = f.museu;

select * from fichas;

-- passar cidade da ficha pra museu
alter table museus
add column cod_cidade int;
alter table museus 
	add constraint fk_museus_cod_cidade
	foreign key (cod_cidade)
	references cidades(cod_cidade);

update museus m
join fichas f on m.codigo = f.museu
	set m.cod_cidade = f.cod_cidade;

select * from museus;

alter table fichas 
drop constraint fk_fichas_cidade;
alter table fichas
drop column cod_cidade;

select *  from fichas;

-- qtd ficha e replicar ficha museu 1
select count(*) as qtd_fichas from fichas where museu = 1;

insert into fichas (indice, horario_funcionamento_administrativo, horario_atendimento_publico, telefone,endereco, situacao, observacoes, revisitacao,visita_tecnica,museu)
select 3, horario_funcionamento_administrativo, horario_atendimento_publico, telefone,endereco, situacao, observacoes, revisitacao,visita_tecnica,museu from fichas where museu = 1;

insert into itens_fichas (ficha, tema, unidade_analise, unidade_contexto, categoria, sub_categoria, texto)
select 58, tema, unidade_analise, unidade_contexto, categoria, sub_categoria, texto from itens_fichas where ficha = 1;

insert into itens_fichas (ficha, tema, unidade_analise, unidade_contexto, categoria, sub_categoria, texto)
select 59, tema, unidade_analise, unidade_contexto, categoria, sub_categoria, texto from itens_fichas where ficha = 1;

insert into itens_fichas (ficha, tema, unidade_analise, unidade_contexto, categoria, sub_categoria, texto)
select 60, tema, unidade_analise, unidade_contexto, categoria, sub_categoria, texto from itens_fichas where ficha = 1;

select * from itens_fichas where ficha = 58; --museu = 1;

---- reverter exclusao
INSERT INTO `imagens_museus` (`codigo`, `codigo_museu`, `nome`, `descricao`) VALUES
(30, 1, '2016.11.12-10.23.47-0.jpg', '1 Museu Hist√≥rico e Pedag√≥gico de Gar√ßa'),
(31, 1, '2016.11.12-10.24.14-0.jpg', '2 Espa√ßo expositivo t√©rreo'),
(32, 1, '2016.11.12-10.24.36-0.jpg', '3 Sala Desbravadores'),
(33, 1, '2016.11.12-10.24.50-0.jpg', '4 Sala Economia'),
(34, 1, '2016.11.12-10.25.11-0.jpg', '5 Sala Manolo'),
(35, 1, '2016.11.12-10.25.36-0.jpg', '6 Sala Curiosidades'),
(36, 1, '2016.11.12-10.25.51-0.jpg', '7 Quiosque'),
(253, 1, '2016.11.24-10.39.22-0.jpg', '8 Sala multidisciplinar e reserva t√©cnica');

select * from imagens_museus im where codigo between 30 and 36 or codigo = 253;


select count(*) as qtd_fichas from fichas where museu = 1;


select * from museus;

-- novo campo periodo pandemico
select * from fichas f ;

alter table museus 
add column periodo_pandemico text;

select * from museus;
