<?php
    include 'PedidosService.php';    

    header("Content-Type: application/json; charset=UTF-8"); 

   
    
    if ($_GET['url']){// se houver url ele cria a variável $url 
       
      
        $url = explode('/' , $_GET['url']);
        //var_dump($url);  // mostrar a url
         
        if ($url[0] === 'api' ){//se estiver tentando acessar a api 
            // Removendo a primeira posição do registro e retorna o resto (neste caso api)          
            array_shift($url);
            
            //var_dump($url);  // mostrar a url 
            $service = ucfirst($url[0]).'Service' ; 
            //Removendo a primeira posição do registro (neste caso Alunos)
            array_shift($url); //neste caso $url ficar como um vetor vazio                      
            
            $method = strtolower( $_SERVER['REQUEST_METHOD']); // metodo get ou post (minusculo)  
  
            //Acesso aos dados do BD: get, post, put e delete
            try {
                // chamando o metodo call_user_func_array(..) para buscar os dados
                $response =  call_user_func_array(array(new  $service , $method), $url) ;                
                http_response_code(200) ; // ok
                //convertendo o resultado em json e mostrando os dados;
                echo json_encode( array('status' => 'sucess' , 'data' => $response));                
            } catch (Exception $e) {
                http_response_code(404) ; // erro
                //mostrando a mensagem de erro (não encontrado);
                echo json_encode( array('status' => 'error' , 'data' => $e->getMessage()));                
            }  
        } 
    }
