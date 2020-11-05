function validarCampo()
{
    var variavel = document.querySelector('#Variaveis');
    var restricao = document.querySelector('#Restricoes');
    var avisoV = document.querySelector('#avisov');
    var avisoR = document.querySelector('#avisor');

        if(variavel.value == '')
        {
            console.log(avisoV);
            console.log(avisoV.textContent);
            avisoV.textContent = 'Digite a quantidade de variaveis';
            variavel.focus();
            return false;
        }
        else if(restricao.value == '')
        {
            avisoV.textContent = '';
            console.log(avisoR);
            console.log(avisoR.textContent);
            avisoR.textContent = 'Digite a quantidade de restrições';
            restricao.focus();
        }
        else{
            avisoV.textContent = '';
            avisoR.textContent = '';
            document.querySelector('#userForm').submit();

        }
    
}
