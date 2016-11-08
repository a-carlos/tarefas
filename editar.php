<?php

require 'banco.php';
require 'ajudantes.php';

$exibir_tabela = false;

if ( array_key_exists('nome', $_POST) && $_POST['nome'] != '')
{
    $tarefa = [];

    $tarefa['id'] = $_POST['id'];

    $tarefa['nome'] = $_POST['nome'];

    if (array_key_exists('descricao', $_POST))
    {
        $tarefa['descricao'] = $_POST['descricao'];
    } else {
        $tarefa['descricao'] = '';
    }

    if (array_key_exists('prazo', $_POST))
    {
        $tarefa['prazo'] = traduz_data_para_banco($_POST['prazo']);
    } else {
        $tarefa['prazo'] = '';
    }

    $tarefa['prioridade'] = $_POST['prioridade'];

    if (array_key_exists('concluida', $_POST))
    {
        $tarefa['concluida'] = 1;
    } else {
        $tarefa['concluida'] = 0;
    }

    editar_tarefa($conexao, $tarefa);

     header('Location: tarefas.php');
    die();
}

$tarefa = buscar_tarefa($conexao, $_GET['id']);

require 'template.php';