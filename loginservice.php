<?php
//arquivo de controle
include 'login.php';
class loginservice
{
    //Funcao para consulta de dados
    public function post()
    {
        $dados = json_decode(file_get_contents('php://input'), true, 512);
        if($dados == null){
            throw new Exception ("Login não encontrado!!!");
        }
        return login::verificarLogin($dados);
    }
}


?>