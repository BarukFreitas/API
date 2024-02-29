<?php

    define('TOKEN', 'meutoken');

    if(isset($_GET['token'])){
        $token = $_GET['token'];
        if($token == TOKEN){


            if(isset($_GET["acao"])) {
                $pdo = new PDO('mysql:host=localhost;dbname=API_Curso','root','bakanoyuba');
                $acao = $_GET['acao'];

                if($acao == 'novo_contato'){
                    $nome = isset($_GET['nome']) ? $_GET['nome'] : '';
                    $sql = $pdo->prepare('INSERT INTO `clientes` VALUES (null,?)');
                    if($sql->execute(array($nome))){

                        die(json_encode(array('sucesso'=>true,'inserido'=>$nome)));
                    }else{
                        die(json_encode(array('sucesso'=>false,'erro'=>'Não foi possível inserir seu contato')));
                    };
                    
                }else if($acao == 'deletar_contato'){
                    if(!isset($_GET['id'])){
                        die(json_encode(array('erro'=>'Precisamos de um ID.')));    
                    };
                    $id = (int)$_GET['id']; 
                    $sql = $pdo->prepare('DELETE FROM `clientes` WHERE id = ?');
                    if($sql->execute(array($id))){
                        die(json_encode(array('sucesso'=>true,'deletado'=>$id)));
                    }else{
                        die(json_encode(array('sucesso'=>false,'erro'=>'Não foi possivel deletar')));
                    }
                }else if($acao == 'atualizar_contato'){

                }else if($acao == 'visualizar_contato'){
                    if(!isset($_GET['id'])){
                        die(json_encode(array('erro'=>'Precisamos de um ID valido para mostrar.')));    
                    };
                    $id = (int)$_GET['id'];
                    $sql = $pdo->prepare('SELECT * FROM `clientes` WHERE id = ?');
                    $sql = execute(array($id));

                    if($sql->rowCount() >=1){
                        $dados = $sql->fetch();
                        die(json_encode($dados));
                    }else{
                        die('Não encontramos nenhum usuário com este ID.');
                    }
                }else{
                    die('A ação não é valida em nosso sistema de API.');
                }

            }else{
                die('Você não pode conectar na API sem uma ação definida.');
            }
        
        }else{
            die('Não foi possível conectar na API, seu token está errado.');
        }

    }
    else{
            die('Você precisa especificar um token de segurança');
    };        
    

?>