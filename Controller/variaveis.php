<?php
if(isset($_POST['qtdVariaveis']) && !empty($_POST['qtdVariaveis']))
{
    $_SESSION['qtdVariaveis'] = intval($_POST['qtdVariaveis']);                         
    echo "<form id='userForm1' action='?action=variaveis' method='POST'>";
    echo "<h3>Digite o falor do seu FO MAX(Z)</h3>";
    echo "<p>caso a variável esteja vazia será considerado o valor 1</p>";
    echo "<p>caso a variável não exista coloque 0</p>";
    for($i = 1; $i <= $_SESSION['qtdVariaveis']; $i++)
    {
        $sinal = $i == $_SESSION['qtdVariaveis'] ? '' :  '+' ;              
        echo "<input type='text' class='variavel' name='variavel$i' size='4'>";
        echo "<label>X$i $sinal </label>";                     
    }
}else
{
}

if(isset($_POST['qtdRestricoes']) && !empty($_POST['qtdRestricoes']))
{
    $_SESSION['$qtdRestricoes'] = $_POST['qtdRestricoes'];                         
    echo "<h3>Digite suas restrições</h3>";
    echo "<p>caso a restrição esteja vazia sera considerado o valor 1</p>";
    echo "<p>caso a restrição não exista coloque 0</p>";
    for($i = 1; $i <= $_SESSION['$qtdRestricoes']; $i++)
    {
        echo "<label>Restrição $i</label>";
        for($x = 1; $x <= $_SESSION['qtdVariaveis']; $x++)
        {                        
            $sinal = ($x-1) == $_SESSION['qtdVariaveis'] ? '' :  '+' ;
            echo "<input type='text' class='variavel' name='variavel$i$x' size='4'>";
            echo "<label>X$x $sinal </label>";                    
        }
        echo " <= ";
        echo "<input type='text' class='variavel' name='total$i' size='4' placeholder=' Total '>";
        echo '<br>';   
    }         
    echo "<input type='submit' class='btn btn-success margin-left-10' value = 'Entrar'>";
    echo "</form>";  
} 
else
{
    echo "<br>";
}      


        
    