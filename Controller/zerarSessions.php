<?php

session_start();
// ZERANDO AS VARIAVEIS;
for($i = 1; $i <= intval($_SESSION['$qtdvariaveis']); $i++)
{
    unset($_SESSION["variavel$i"]);
    unset($_SESSION["foValor$i"]);
}

//ZERANDO
for($i = 1; $i <= intval($_SESSION['$qtdRestricoes']); $i++)
{
    unset($_SESSION["restricao$i"]);
    unset($_SESSION["exibirRestricao$i"]);
    unset($_SESSION["totalRestricao$i"]);
    for($x = 1; $x <= intval($_SESSION['$qtdvariaveis']); $x++)
    {
        unset($_SESSION["variaveisXF$i$x"]);
    }
}

unset($_SESSION['qtdVariaveis']);
unset($_SESSION['$qtdRestricoes']);
unset($_SESSION['ax']);

header('location:../index.php');