<?php

    include 'Pedidos.php'; 
    class PedidosService 
    {
          public function get( $id = null )
          {
              if ($id){ 

               // return Pedidos::find($id);
                return Pedidos::select($id);

              }else{
                 
                 return Pedidos::selectAll() ;
              }

          }

          public function post()
          {
              $dados = json_decode(file_get_contents("php://input"), true, 512);
              if ($dados == null)
              {
               throw new Exception("Falta os dados para input");
              }

              return Pedidos::insert($dados);
          }

          public function put($id = null)
          {
              if ($id == null){
                throw new Exception("Falta o codigo !");
              }
              
              $dados = json_decode(file_get_contents('php://input'), true, 512);
              if ($dados == null){
                throw new Exception("Falta informação!");
              }
              return Pedidos::update($id,$dados);              
          }



          public function delete($id = null)
          {
              if ($id == null)
              {
               throw new Exception("Falta o codigo !");
              }

              return Pedidos::delete($id);
          }
         
    }
?>