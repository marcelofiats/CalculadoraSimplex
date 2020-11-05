<?php
if($_POST){
    $_SESSION["ax"] = false;
    for($i = 1; $i <= $_SESSION['qtdVariaveis']; $i++)
    {
        if(empty($_POST["variavel$i"]))
        {
            $_POST["variavel$i"] = 1;                      
        }
        $_SESSION["variavel$i"] = $_POST["variavel$i"];                
    } 
    
    for($i = 1; $i <= intval($_SESSION['$qtdRestricoes']); $i++)
    {
        $_SESSION["exibirRestricao$i"] = '';
        for($x = 1; $x <= $_SESSION['qtdVariaveis']; $x++)
        {   
            $sinal = ($x) == intval($_SESSION['qtdVariaveis']) ? '' :  '+' ;
            if($_POST["variavel$i$x"] == '')$_POST["variavel$i$x"] = 1;
            $rest = $_POST["variavel$i$x"];               
            $_SESSION["restricao$i$x"] = intval($rest); 
            $_SESSION["exibirRestricao$i"] .= "$rest X$x $sinal";
        }
        for($j = 1; $j <= intval($_SESSION['$qtdRestricoes']); $j++)
        {
            if($i == $j)$_SESSION["variaveisXF$i$j"] = 1; 
        }        
        $_SESSION["totalRestricao$i"] = $_POST["total$i"];
        $_SESSION["exibirRestricao$i"] .= " <= ".$_POST["total$i"];
        $_SESSION["ax"] = true;
    }
    
}