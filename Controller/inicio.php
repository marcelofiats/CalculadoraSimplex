<?php
session_start();

if($_GET){
    $acao = $_GET['action'];
    switch($acao)
    {
        case $acao == 'iniciar': include 'variaveis.php'; break;

        case $acao == 'variaveis': include 'recebendoValores.php';break;

        case $acao == 'qtdrestricoes': include 'restricoes.php';break;

        case $acao == 'restricoes': include 'recebendorestricoes.php';break;        

        default: break;
    }
}
