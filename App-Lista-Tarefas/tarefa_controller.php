<?php

    //requires
    require 'tarefa.model.php';
    require 'tarefa.service.php';
    require 'conexao.php';

    $parametro = isset($_GET['acao']) ? $_GET['acao'] : $acao;

   

    if($parametro == 'inserir') //verifica via parametro se a condição é de inserção
    {

        //Instancia da classe Tarefas
        $tarefa = new Tarefa();
        $tarefa->__set('tarefa', $_POST['tarefa']);

        //Conexão com o BDD
        $conexao = new Conexao();

        //Instancia da Classe de CRUD
        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefaService->inserir();
        
        header('location: nova_tarefa.php?inclusao=1');

    }
    else if($parametro == 'recuperar') //entra via parametro na listagem de recuperação do BDD
    {
        $tarefa = new Tarefa();
        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefasArray = $tarefaService->recuperar();

    }
    else if($parametro == 'atualizar') //entra via parametro na atualização dos dados
    {
        $tarefa = new Tarefa();
        $tarefa->__set('id', $_POST['id'])->
                 __set('tarefa', $_POST['tarefa']);

        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa);

         if($tarefaService->atualizar() > 0) //Direciona para a pagina 'todas_tarefas' caso tenha o retorno positivo do BDD
         {
            if(isset($_GET['pag']) && $_GET['pag'] == 'index'){
                header('location: index.php');
                }
                else{
                    header('location: todas_tarefas.php');
                }
         }

    }
    else if($parametro == 'remover') //entra via parametro na remoção dos dados
    {
        $tarefa = new Tarefa();
        $tarefa->__set('id', $_GET['id']);

        $conexao = new Conexao();
        
        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefaService->remover();

        if(isset($_GET['pag']) && $_GET['pag'] == 'index'){
            header('location: index.php');
        }
        else{
            header('location: todas_tarefas.php');
        }
    }
    else if($parametro == 'marcarRealizada') //entra via parametro para a marcação dos dados
    {
        $tarefa = new Tarefa();
        $tarefa->__set('id', $_GET['id']);
        $tarefa->__set('id_status', 2);

        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefaService->marcarRealizada();

        if(isset($_GET['pag']) && $_GET['pag'] == 'index'){
        header('location: index.php');
        }
        else{
            header('location: todas_tarefas.php');
        }
    }
    else if($parametro == 'tarefas-pendentes') //entra via parametro para listar as tarefas pendentes
    {
        
        $tarefa = new Tarefa();
        $tarefa->__set('id_status', 1);

        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa);
        
        $tarefasArray = $tarefaService->listarPendentes();   
        
    }
    
?>