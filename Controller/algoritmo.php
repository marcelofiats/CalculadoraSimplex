<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <title>Document</title>
</head>
<body>
        <?php
        session_start();
        require_once 'calculo.php';
        
        $zero = 0;
        $um = 1;
        $calculo = new Calculo;
          //valores de Z 
           $calculo -> AddValorZ(-1);
           for($x = 1; $x <= intval($_SESSION['qtdVariaveis']); $x++)
           {
            $calculo -> AddValorZ(intval($_SESSION["variavel$x"]));
           }
           for($x = 1; $x <= intval($_SESSION['$qtdRestricoes']); $x++)
           {
            $calculo -> AddValorZ($zero);
           }
            $calculo -> AddValorZ($zero);


          for($i = 1; $i <= intval($_SESSION['$qtdRestricoes']); $i++)
          {        
            $calculo -> AddRestricao($zero);
            for($x = 1; $x <= intval($_SESSION['qtdVariaveis']); $x++)
            {
                $calculo -> AddRestricao(intval($_SESSION["restricao$i$x"]));
            }
            for($j = 1; $j <= intval($_SESSION['$qtdRestricoes']); $j++)
            {
              if(!isset($_SESSION["variaveisXF$i$j"])) $_SESSION["variaveisXF$i$j"] = $zero;
              $calculo -> AddRestricao(intval($_SESSION["variaveisXF$i$j"]));
            }
            $calculo -> AddRestricao(intval($_SESSION["totalRestricao$i"]));
          }
          $size = intval($_SESSION['qtdVariaveis']) + intval($_SESSION['$qtdRestricoes']) + 2;
          ?>
  <div class="principal">    
    <div class="center margin-top-30">
    <table  class='table table-bordered'>
        <thead>
          <tr><th colspan="<?php echo $size ?>">Algoritmo 1</th></tr>
        </thead>
          <tr>
          <th> Z </th>
          <?php
          for($x = 1; $x <= intval($_SESSION['qtdVariaveis']); $x++)
            {
                echo "<th>X".$x."</th>";
            }
          for($i = 1; $i <= intval($_SESSION['$qtdRestricoes']); $i++)
            {
              echo "<th>XF$i</th>";
            }
          ?>
          <th> b </th>
          </tr>
      <?php
        $calculo -> setqtdVariaveis(intval($_SESSION['qtdVariaveis']));
        $calculo -> iniciar($size);
      ?>
      </table>    
      
  </div>
  <br/>
  <a href="../index.php"><button  class="btn btn-dark"> Voltar </button></a> 
  </div>
  
  
</body>
</html>

