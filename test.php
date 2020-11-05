<?php 

echo "Olá";

include 'Controller/calculo.php';

$test = new Calculo;

$test->AddValorZ(5);
$test->AddValorZ(6);
$test->AddValorZ(7);
$test->AddValorZ(8);

$test ->PrintValorZ();