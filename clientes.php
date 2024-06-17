<?php
include_once 'config.php';
//Criamos a classe

class Clientes
{
    public static function select (int $id){
        $tabela = "clientes";
        $coluna = "id_cliente";

        $connPdo = new PDO(dbDrive.':host='.dbHost.';dbname='.dbName,dbUser,dbPass);

        $sql = "select * from $tabela where $coluna = :id";

        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            return $stmt->fetch(PDO::FETCH_ASSOC);

        }else{
            throw new Exception("Sem registros");
        }

    }
    public static function selectAll()
    {
        $tabela = "clientes";

        try {
            $connPdo = new PDO(dbDrive . ':host=' . dbHost . ';dbname=' . dbName, dbUser, dbPass);
            $connPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM $tabela";

            $stmt = $connPdo->prepare($sql);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                throw new Exception("Sem registros");
            }
        } catch (PDOException $e) {
            echo "Erro na conexão: " . $e->getMessage();
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    //metodo para inclusao de dados no BD
    public static function insert($dados)
    {
        $tabela = "clientes";
        $connPdo = new PDO(dbDrive.':host='.dbHost.';dbname='.dbName,dbUser,dbPass);
        $sql = "insert into $tabela (nome_cliente, email_cliente, endereco_cliente, telefone_cliente, cpf) values (:nome_cliente, :email_cliente,:endereco_cliente,:telefone_cliente,:cpf)";
        $stmt = $connPdo->prepare($sql);
        
        //mapeando os parametros (nome,email,etc) para obter os dados de inclusao
        $stmt->bindValue(':nome_cliente', $dados['nome_cliente']);
        $stmt->bindValue(':email_cliente', $dados['email_cliente']);
        $stmt->bindValue(':endereco_cliente', $dados['endereco_cliente']);
        $stmt->bindValue(':telefone_cliente', $dados['telefone_cliente']);
        $stmt->bindValue(':cpf', $dados['cpf']);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return 'Dados cadastrados com sucesso!!!' ;
        } else {
            throw new Exception("Erro ao cadastrar");
        }
    }
    //metodo para alterar dados
    public static function update($id, $dados)
    {
        $tabela = "clientes";
        $coluna = "id_cliente";
        $connPdo = new PDO(dbDrive.':host='.dbHost.';dbname='.dbName,dbUser,dbPass);
        $sql = "update $tabela set nome_cliente = :nome_cliente, email_cliente = :email_cliente, endereco_cliente = :endereco_cliente, telefone_cliente = :telefone_cliente, cpf = :cpf where $coluna= :id_cliente";
        $stmt = $connPdo->prepare($sql);
         //mapeando os parametros (nome,email,etc) para obter os dados para alteracao
         $stmt->bindValue(':nome_cliente', $dados['nome_cliente']);
         $stmt->bindValue(':email_cliente', $dados['email_cliente']);
         $stmt->bindValue(':endereco_cliente', $dados['endereco_cliente']);
         $stmt->bindValue(':telefone_cliente', $dados['telefone_cliente']);
         $stmt->bindValue(':cpf', $dados['cpf']);
         $stmt->bindValue(':id_cliente', $id);
         $stmt->execute();

         if ($stmt->rowCount() > 0)
         {
             return "Dados alterados com sucesso!";
         }else{
             throw new Exception("Erro ao alterar os dados!!");
         }
    }

    //metodo para excluir dados
    public static function delete($id)
    {
        $tabela = "clientes";
        $coluna = "id_cliente";
        $connPdo = new PDO(dbDrive.':host='.dbHost.';dbname='.dbName,dbUser,dbPass);
        $sql = "delete from $tabela where $coluna = :id_cliente";
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':id_cliente' , $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0)
        {
            return "Dados excluidos com sucesso!";
        }else{
            throw new Exception("Erro ao excluir dados");
        }
    }
};
?>