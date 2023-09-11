<?php

$cores = array();

array_push($cores, 1);
array_push($cores, 2);
array_push($cores, 4);
array_push($cores, 5);
array_push($cores, 7);

/*
echo "(";
foreach ($cores as $cor) {
	echo $cor;
}
echo ")";
*/

$resultado = implode(" - ", $cores);

echo $resultado;