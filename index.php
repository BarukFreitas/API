<?php

    //TOKEN - token de segurança para validar e saber o que estamos chamando a api
    //AÇÃO - o que vamos fazer
    //ID - ID do cliente
    //VALOR - nome do cliente ou atualização do cliente

    define('TOKEN', 'meutoken');

    if(isset($_GET['token'])){
        $token = $_GET['token'];
        if($token == TOKEN){
            //PODEMOS CONTINUAR NA API, TEMOS ACESSO

            if(isset($_GET["acao"])) {
                $acao = $_GET['acao'];

                if($acao == 'novo_contato'){
                    die(json_encode(array('sucesso'=>true)));
                }else if($acao == 'deletar_contato'){

                }else if($acao == 'atualizar_contato'){

                }else if($acao == 'visualizar_contato'){

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