<?php
    //este é para execucao da api de consultas
    include 'clientesservice.php';
    include 'loginservice.php';
    //colocando o cabecalho para retornar os dados em formato json
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Origin: *");  // Necessário para a mesma máquina (localhost)  

    header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE");
    header("Access-Control: no-cache, no-store, must-revalidate");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Max-Age: 86400");


    //$_GET é uma variavel do tipo array[] que pega o link 
    
    if($_GET['url']){//se houver url ele cria a variavel $url
        
        $url = explode('/', $_GET['url']);
        //var_dump($url); mostra na tela a url

        if($url[0] === 'api'){
            //removendo a primeira posicao do registro e retorna o resto (nesse caso a api)
            array_shift($url);

            // ucfirst - converte para maiusculo o primeiro caracter de uma string
            
            $service = ucfirst($url[0]).'service';
            //removendo a primeira posicao do registro(nno caso clientes)
            array_shift($url); //nesse caso a $url fica vazia

            $method = strtolower($_SERVER['REQUEST_METHOD']); //metodo get ou post munusculo
            //$method = $_SERVER['REQUEST_METHOD']; // metodo get ou post em maiusculo


            //Acesso aos dados do BD: get, post, put e delete
            try{
                //chamando metodo call user func array(..) para buscar os dados;
                $response = call_user_func_array(array(new $service , $method), $url);
                http_response_code(200); //ok
                //convertendo o resultado em json e mostrando os dados;
                echo json_encode(array('status' => 'success' , 'data' => $response));
            } catch(Exception $e){
                http_response_code(404); //erro
                //mostrando a mensagem de erro;
                echo json_encode(array('status' => 'error', 'data' => $e->getMessage()));
            }
        }
    }



?>