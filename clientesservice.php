<?php
    //servicos oferecidos pela API
    include 'clientes.php'; //inclui o arquivo clientes.php

    class ClientesService
    {
        //metodo GET para consulta
        //quando "$id = null" significa que pode ou nao ter esse parametro
        public function get( $id = null)
        {
            if($id) //se existe id
            {
                //se tiver id ele retorna
                return clientes::select($id);
            }else
            {
                //se nao, ele retorna todos
                return clientes::selectAll();
            }

        }
        //funcao para inclusao de dados
        public function post()
        {
            //transformando os dados em formato JSON para incluir no BD
            $dados = json_decode(file_get_contents('php://input'),true, 512);
            if($dados == null)
            {
                throw new Exception ('Não foi possivel cadastrar os dados!!');
            }
            
            return clientes::insert($dados);
        }

        //funcao para alteracao de dados
        public function put($id = null)
        {
            if ($id == null){
                throw new Exception("Falta o codigo!");
            }
            //Pegar as info para atualizar o BD
            $dados = json_decode(file_get_contents('php://input'), true, 512);
            if ($dados == null){
                throw new Exception("Falta informação!");
            }
            return clientes::update($id,$dados);
        }

        // funcão para exclusão de dados
        public function delete($id = null)
        {
            if ($id == null){
            throw new Exception("Falta o codigo !");
        }
            return clientes::delete($id);
}
    }
    




?>