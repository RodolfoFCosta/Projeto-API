<?php
    
      require_once 'config.php'; 
      
      class Pedidos  
      {

        public static function select(int $id)
        {
            $tabela = "pedidos"; //variável para nome da tabela
            $coluna = "codigo"; //variável para chave primaria
            
            // Conectando com o banco de dados através da classe (objeto) PDO
            // pegando as informações do config.php (variáveis globais)
            $connPdo = new PDO(dbDrive.':host='.dbHost.'; dbname='.dbName, dbUser, dbPass);
            
            // Usando comando sql que será executado no banco de dados para consultar um 
            // determinado registro 
            $sql = "select * from $tabela where $coluna = :id" ;
            
            //preparando o comando Select do SQL para ser executado usando método prepare()
            $stmt = $connPdo->prepare($sql);  

            //configurando (ou mapear) o parametro de busca
            $stmt->bindValue(':id' , $id) ;
           
            // Executando o comando select do SQL no banco de dados
            $stmt->execute() ;
           
            if ($stmt->rowCount() > 0) // se houve retorno de dados (Registros)
            {
                //imprimir usando : var_dump( $stmt->fetch(PDO::FETCH_ASSOC) );

                // retornando os dados do banco de dados através do método fetch(...)
                return $stmt->fetch(PDO::FETCH_ASSOC) ;
                
            }else{// se não houve retorno de dados, jogar no classe Exception (erro)
                  // e mostrar a mensagem "Sem registro do aluno"                
                throw new Exception("Sem registro do aluno");
            }

        }
        
        public static function selectAll()
        {
            $tabela = "pedidos"; 
            
            $connPdo = new PDO(dbDrive.':host='.dbHost.'; dbname='.dbName, dbUser, dbPass);
            //criar execução de consulta usando a linguagem SQL
            $sql = "select * from $tabela"  ;
            // preparando o comando Select do SQL para ser executado usando método prepare()
            $stmt = $connPdo->prepare($sql);
            // Executando o comando select do SQL no banco de dados
            $stmt->execute() ;

            if ($stmt->rowCount() > 0) // se houve retorno de dados (Registros)
            {
                // retornando os dados do banco de dados através do método fetchAll(...)
                return $stmt->fetchAll(PDO::FETCH_ASSOC) ;
            }else{
                throw new Exception("Sem registros");
            }
        }

        public static function insert($dados)
        {
            $tabela = 'pedidos'; //variavel para nome da tabela "Pedidos"
            $connPdo = new PDO(dbDrive.':host='.dbHost.'; dbname='.dbName, dbUser, dbPass);
            $sql = "insert into $tabela (nome,descricao,endereco,telefone) values (:nome,:descricao,:endereco,:telefone)";
            $stmt= $connPdo->prepare($sql);
            // Mapear os parametros para obter os dados de inclusão.
            $stmt ->bindValue(':nome',$dados['nome']);
            $stmt ->bindValue(':descricao',$dados['descricao']);
            $stmt ->bindValue(':endereco',$dados['endereco']);
            $stmt ->bindValue(':telefone',$dados['telefone']);

            $stmt->execute();//executar a query sql

            if($stmt->rowcount() > 0) 
            {
                return 'Dados Cadastrados com sucesso!';
            } else{
                throw new Exception("Erro ao cadastrar!");
            }
        }

        public static function update($id,$dados)
        { 
            $tabela = "pedidos"; //uma variável para nome da tabela "pedidos"
            $coluna = "codigo"; //uma variável para nome "codigo"
            $connPdo = new PDO(dbDrive.':host='.dbHost.'; dbname='.dbName, dbUser, dbPass);
            $sql = "update $tabela set nome=:nome,descricao=:descricao,endereco=:endereco,telefone=:telefone where $coluna=:id";
            $stmt = $connPdo->prepare($sql);
            //Mapear os parâmetros para obter os dados de inclusão
            $stmt->bindValue(':id', $id);
            $stmt->bindValue(':nome', $dados['nome']);
            $stmt->bindValue(':descricao', $dados['descricao']);
            $stmt->bindValue(':endereco', $dados['endereco']);
            $stmt->bindValue(':telefone', $dados['telefone']);
            $stmt->execute() ;
    
            if ($stmt->rowCount() > 0) // se houve os dados (Registros)
            {                
                return 'Dados alterados com sucesso!' ;
            }else{
                throw new Exception("Erro ao alterar os dados");
            }
        }

        public static function delete($id)
        {
            $tabela = 'pedidos'; 
            $coluna = "codigo"; 

            $connPdo = new PDO(dbDrive.':host='.dbHost.'; dbname='.dbName, dbUser, dbPass);
            $sql = "delete from $tabela where $coluna = :id";
            $stmt = $connPdo->prepare($sql);
            $stmt->bindValue(':id' , $id);
            $stmt->execute();

            if($stmt->rowcount() > 0) 
            {
                return 'Dados Excluidos com sucesso!';
            } else{
                throw new Exception("Erro ao Excluir!");
            }

        }

    }