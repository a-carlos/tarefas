<?php
session_start();

//ar_dump($_SESSION);

if (array_key_exists('nome', $_GET) && $_GET['nome'] != '')
{
    $tarefa = [];

    $tarefa['nome'] = $_GET['nome'];

    if (array_key_exists('descricao', $_GET)) {
        $tarefa['descricao'] = $_GET['descricao'];
    } else {
        $tarefa['descricao'] = '';
    }

    if ( array_key_exists('prazo', $_GET) ){
        $tarefa['prazo'] = $_GET['prazo'];
    } else {
        $tarefa['prazo'] = '';
    }

    $tarefa['prioridade'] = $_GET['prioridade'];

    if ( array_key_exists('concluida', $_GET) ){
        $tarefa['concluida'] = $_GET['concluida'];
    } else {
        $tarefa['concluida'] = '';
    }

    $_SESSION['lista_tarefas'][] = $tarefa;
}

$lista_tarefas = [];

if( array_key_exists('lista_tarefas', $_SESSION))
{
    $lista_tarefas = $_SESSION['lista_tarefas'];
}

//var_dump($_GET);

include "template.php";
