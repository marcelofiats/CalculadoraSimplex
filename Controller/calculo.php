<?php
class Calculo
{
    public $count = 2;
    public $restricao;
    public $size;
    public $qtdVariaveis;
    public $tentativas = 0;

    public function AddValorZ($valor)
    {
        $this->restricao[] = ($valor*-1);
    }

    public function AddRestricao($valor)
    {
        $this->restricao[] = $valor;
    }

    public function setqtdVariaveis($value){
        $this->qtdVariaveis = $value;
    }

    // aqui defini o tamanho dos arrays que serao divididos
    public function setSize($value)
    {
        $this->size = $value;
        $this->tentativas = 0;
    }

    public function iniciar($size){
        $this -> setSize($size);
        $restricoes = $this -> Soma($this->restricao);
        $novasLinhas = $this -> CalculoSimplex($restricoes);
        $this -> ImprimirResultado($novasLinhas);
    }

    public function Soma($restricao)
    {
        $restricoes = array_chunk($restricao, $this->size); 
        for($i = 0; $i < count($restricoes); $i++)
        {   
            echo "<tr>";   
            foreach($restricoes[$i] as $index => $valor)
            {
                echo "<td>".$valor."</td>";
            }
            echo "</tr>";
        }
        return $restricoes;
    }

    function PosicaoMenorValorZ ($restricoes)
    {
        $index = $restricoes[0];
        unset($index[count($index)-1]);
        $Menor = min($index);
        $MenorValorZ = array_search($Menor, $index);
        return ($MenorValorZ);
    }

    public function CalculoReferencia($array, $posicao)
    {  
        $calculoZ = (end($array) / $array[$posicao]);
        return $calculoZ;
    }
    
    function LinhaOut($restricoes)
    {
        $resultado = 0;
        $menorValor = $this->PosicaoMenorValorZ($restricoes);
        foreach($restricoes as $key => $valor)
        {
            $index = $this->CalculoReferencia($restricoes[$key], $menorValor);
            if($resultado <= 0 || $index < $resultado)
            {   
                $resultado = $index;
                $linha = $key;
            }
        }            
        $linhaOut = $restricoes[$linha];
        return $linhaOut;
   }

    public function NovaLinhaPivo($linhaOut, $restricoes)
    {
        $posicao = 0;
        $posicao = $this->PosicaoMenorValorZ ($restricoes);
        foreach($linhaOut as $key => $valor)
        {  
            if($linhaOut[$posicao] == 0) $novaLinhaPivo[] = 0;             
            else $novaLinhaPivo[] = ($valor/$linhaOut[$posicao]);
        }
        return $novaLinhaPivo;
    }

    public function CalculoSimplex($restricoes)
    {
        $linhaOut = $this -> LinhaOut($restricoes);
        $novaLinhaPivo = $this -> NovaLinhaPivo($linhaOut, $restricoes);
        foreach($restricoes as $key => $valor)
        {            
            foreach($valor as $key2 => $valor2)
            {
                if(array_diff($linhaOut, $restricoes[$key]) == null)
                {
                    $NovaLinha[] = $novaLinhaPivo[$key2];                        
                }else
                {
                $posicao = $this->PosicaoMenorValorZ ($restricoes);
                $NovoCoeficiente = $novaLinhaPivo[$key2] *-$valor[$posicao]; 
                $NovaLinha[] = $valor2 + $NovoCoeficiente;
                }               
            }
        }
        $novasLinhas = array_chunk($NovaLinha, $this->size);
        return $novasLinhas;
    }

    public function ExibirSolucao($array){
        foreach($array as $key => $valor){
            if($valor < 0){
                return false;
            }            
        }
        return true;
    }

    public function ImprimirResultado($novasLinhas)
    {
        echo "<table  class='table table-bordered'>";
        echo "<thead>";
        echo "<tr><th colspan=$this->size>Algoritmo $this->count</th></tr>";
        echo "</thead><tr><th> Z </th>";
        for($x = 1; $x <= intval($_SESSION['qtdVariaveis']); $x++)
            {
                echo "<th>X".$x."</th>";
            }
          for($i = 1; $i <= intval($_SESSION['$qtdRestricoes']); $i++)
            {
              echo "<th>XF$i</th>";
            }
        echo "<th> b </th></tr>";        

        foreach($novasLinhas as $key => $valor)
        {
            echo "<tr>";
            foreach($valor as $key2 => $valor2){
                echo "<td>".$valor2."</td>";
            }
            echo '</tr>';
        }
        echo "</table>";
        $this->count++;
        
        for($j = 1; $j<count($novasLinhas[0])-1;$j++){
            $soma = 0;
            for($i = 0; $i < count($novasLinhas); $i++){
                if($novasLinhas[$i][$j] >= 0){
                    $soma = $novasLinhas[$i][$j] + $soma;
                    if($novasLinhas[$i][$j] == 1){
                        $posicao[$j] = $i;
                    }
                }
            }
            $ax[$j] = $soma;

        }
        echo "<div class='row'>";
        echo "<div class='col-4'";    
        echo "<p>Variaveis Basícas</p>";
        for($j = 1; $j<count($novasLinhas[0])-1;$j++)
        {
            $index = 0;
            if($ax[$j] == 1)
            {
                if($j <= $this->qtdVariaveis)echo "X$j = ".$novasLinhas[$posicao[$j]][$this->size-1]."<br>";
                else {
                    $index = $j - $this->qtdVariaveis; 
                    echo "   XF$index = ".$novasLinhas[$posicao[$j]][$this->size-1]."<br>";
                }              
            }
        }
        echo "</div>";
        echo "<div class='col-4'";    
        echo "<p>Variaveis não Basícas</p>";
        for($j = 1; $j<count($novasLinhas[0])-1;$j++)
        {
            if($ax[$j] != 1)
            {
                if($j <= $this->qtdVariaveis)echo "   X$j = 0 <br>";
                else {
                    $index = $j - $this->qtdVariaveis; 
                    echo "   XF$index = 0 <br>";
                }              
            }
        }
        echo "</div>";
        echo "<div class='col-4'";    
        echo "<p>Valor de Z</p>";
        echo $novasLinhas[0][$this->size-1];
        echo "</div></div>";
        
        if($this->ExibirSolucao($novasLinhas[0])){
            echo "<div class='text-success textform'>Solução Otima...<br>";
            for($j = 1; $j<count($novasLinhas[0])-1;$j++)
        {
            $index = 0;
            if($ax[$j] == 1)
            {   
                $sinal = ($j) == $this->qtdVariaveis ? ' = ' :  ' + ' ;
                if($j <= $this->qtdVariaveis)echo $novasLinhas[$posicao[$j]][$this->size-1]." X$j".$sinal;           
            }            
        }
        echo $novasLinhas[0][$this->size-1];
        echo "</div>";

        }
        else{
            echo "<div class='text-danger textform'>solução não Otima...</div>";
            $this->tentativas++;
            if($this->tentativas < 10)
            {
                $novasLinhasResult = $this->CalculoSimplex($novasLinhas);
                $this->ImprimirResultado($novasLinhasResult);
            }else{
                echo "<h3>Muitas tentativas sem sucesso...</h3>";
            }
        }

    }

    
}

?>

