<?php
session_start();

require "config.php";
require "banco.php";
require "ajudantes.php";

require "classes/Tarefa.php";
require "classes/Anexo.php";
require "classes/RepositorioTarefas.php";

$repositorio_tarefas = new RepositorioTarefas($mysqli);

$exibir_tabela = true;

$tem_erros = false; //será alterara pra true conforme as validações aconteçam
$erros_validacao = []; //guardar os erros de validação em cada campoo

$tarefa = new Tarefa();
$tarefa->setPrioridade(1);


if( tem_post())
{
    //a função strlen conta o tamanho de uma string
    //verifica se o nome está no POST e se a contagem de caracteres pe maior que zero
    if ( array_key_exists('nome', $_POST) && strlen($_POST['nome']) > 0 )
    {
        $tarefa->setNome($_POST['nome']);
    } else {
        $tem_erros = true;
        $erros_validacao['nome'] = 'O nome da tarefa é obrigatório';
    }

    if (array_key_exists('descricao', $_POST)) {
        $tarefa->setDescricao($_POST['descricao']);
    } else {
        $tarefa->setDescricao('');
    }

    if ( array_key_exists('prazo', $_POST) && strlen($_POST['prazo']) > 0 )
    {
        if( validar_data($_POST['prazo']) )
        {
            $tarefa->setPrazo(traduz_data_br_para_objeto($_POST['prazo']));
        } else {
            $tem_erros = true;
            $erros_validacao['prazo'] = 'O prazo não é uma data válida';
        }
    } else {
        $tarefa->setPrazo('');
    }

    $tarefa->setPrioridade($_POST['prioridade']);

    if ( array_key_exists('concluida', $_POST) ){
        $tarefa->setConcluida(true);
    } else {
        $tarefa->setConcluida(false);
    }

    if( !$tem_erros )
    {
        $repositorio_tarefas->salvar($tarefa);

        if(isset($_POST['lembrete']) && $_POST['lembrete'] == '1')
        {
            enviar_email($tarefa);
        }

        // evita que a tarefa seja cadastrada novamente ao atualizar a página
        header('Location: tarefas.php');
        die();
    }

}

$tarefas = $repositorio_tarefas->buscar();

include "template.php";