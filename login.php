<?php
//Arquivo de regras de negocio
include_once 'config.php';
class login
{
    //Funcao para verificar ou validar login e senha
    public static function verificarLogin($dados)
    {
        $tabela = "apilogin";
        $colunalogin = "login";
        $colunasenha = "senha";

        //conectando com bd atraves de PDO
        //pegando as info do arquivo config.php (variaveis globais)
        $connPdo = new PDO(dbDrive.':host='.dbHost.'; dbname='.dbName, dbUser, dbPass);

        //comando do banco de dados
        $sql = "select codigologin from $tabela where $colunalogin=:login and $colunasenha=:senha";
        $stmt = $connPdo->prepare($sql);
        //configurando o parametro de busca
        $stmt->bindValue(':login' , $dados['login']);
        $stmt->bindValue(':senha' , $dados['senha']);
        //executando o comando select no bd
        $stmt->execute();

        if($stmt->rowCount() > 0){
            return $stmt->fetch(PDO::FETCH_ASSOC);

        }else{
            throw new Exception("Login Incorreto!!");
        }
    }
}


?>