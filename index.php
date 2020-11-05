<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Calculo de Simplex</title>
</head>
<body>
    <div class="principal">
        <div class="inicio">
            <form action="Controller/zerarSessions.php">
                <button type="submit" name="zerar" class="btn btn-danger zerar">Reiniciar</button>
            </form>
            <h1>Calculo Simplex</h1>
            <!--action="?action=iniciar" -->
            <form action="?action=iniciar" id="userForm" method="Post">
            <p>Quantas Variaveis existem no seu Programa Linear?</p>
                <input type="text" id="Variaveis" name="qtdVariaveis" class="qtdVariaveis">
                <div id="avisov" class="text-danger" name="avisov"></div>
                <p>Quantas Restrições existem no seu Programa Linear?</p>
                <input type="text" id="Restricoes" name="qtdRestricoes" class="qtdRestricoes">
                <div id="avisor" class="text-danger" name="avisor"></div>
                <br>
                <br>
                <input type="button" onclick='validarCampo()' value="Entrar">
            </form>
            <div class="margin-top-30">
            <?php 
                include 'Controller/inicio.php';
            ?>          
            </div>
        </div>
    </div>
    <div class="result">
         <?php             
            if(isset($_SESSION['qtdVariaveis']) && isset($_SESSION["ax"]))
            {
                echo "FO MAX(Z) = ";
                for($i = 1; $i <= $_SESSION['qtdVariaveis']; $i++)
                {
                    $sinal = ($i) == intval($_SESSION['qtdVariaveis']) ? '' :  '+' ;
                    echo strval($_SESSION["variavel$i"] ." X".$i ." ". $sinal);
                }
            }           
         
         if(isset($_SESSION['qtdVariaveis']) && isset($_SESSION["ax"])){
            echo "<br><br><h3>Variaveis: </h3>";
            for($i = 1; $i <= $_SESSION['qtdVariaveis']; $i++)
            {
               echo "X$i";
               echo "<br>"; 
            }
        }

         if(isset($_SESSION["exibirRestricao1"]) && isset($_SESSION['$qtdRestricoes']))
         {
            echo "<br><h3>Restrições: </h3>";
            for($i = 1; $i <= intval($_SESSION['$qtdRestricoes']); $i++)
            {
                echo $_SESSION["exibirRestricao$i"];
                echo "<br>";
            }
        }

        if(isset($_SESSION['qtdVariaveis']) && isset($_SESSION["exibirRestricao1"]))
        {
            echo "<br><h3>Restrições não negativas: </h3>";
            for($i = 1; $i <= $_SESSION['qtdVariaveis']; $i++)
            {
               echo "X$i >= 0";
               echo "<br>"; 
            }
            ?>
        <br>
        <h3>Os Valores estão corretor?</h3>
        <a href="Controller/algoritmo.php"><button  class="btn btn-success botao"> Sim </button></a>
        <button class="btn btn-danger botao"> Não</button>

        <?php
            }
        ?>
         

    </div> 
    
</body>
<script src="js/Validacao.js" type="text/javascript"></script>
</html>