<?php

$dbServidor = '127.0.0.1';
$dbUsuario  = 'root';
$dbSenha    = 'lxroot';
$dbBanco    = 'tarefas';

$conexao = mysqli_connect( $dbServidor, $dbUsuario, $dbSenha, $dbBanco );

if  ( mysqli_connect_errno ($conexao) )
{
    echo "Problemas para conectar no banco. Erro: ";
    echo mysqli_connect_error();
    die();
}


function buscar_tarefas( $conexao )
{
    //realiza uma consulta no banco
    $sqlBusca  = 'SELECT * FROM tarefas';

    //vai ao banco, executa o comando e traz resultado
    $resultado = mysqli_query( $conexao, $sqlBusca );

    //cria o array vazaio tarefas
    $tarefas = [];

    /* mysqli_fetch_assoc passa por todas as linhas do resultado sendo que
     * cada linha é armazenada na variável $tarefa
     *
     *
     */
    while ( $tarefa = mysqli_fetch_assoc( $resultado ) ){
        $tarefas[] = $tarefa;
    }

    return $tarefas;
}

function gravar_tarefa( $conexao, $tarefa)
{
    $sqlGravar = "
            INSERT INTO tarefas
                (nome, descricao, prioridade, prazo, concluida)
            VALUES
                (
                    '{$tarefa['nome']}',
                    '{$tarefa['descricao']}',
                     {$tarefa['prioridade']},
                    '{$tarefa['prazo']}',
                     {$tarefa['concluida']}

                )
        ";

        mysqli_query( $conexao, $sqlGravar );
}

function buscar_tarefa( $conexao, $id )
{
    $sqlBusca = 'SELECT * FROM tarefas WHERE id = '. $id;

    $resultado = mysqli_query( $conexao, $sqlBusca );

    return mysqli_fetch_assoc( $resultado );
}

function editar_tarefa( $conexao, $tarefa )
{
    $sqlEditar = "
        UPDATE tarefas SET
            nome        = '{$tarefa['nome']}',
            descricao   = '{$tarefa['descricao']}',
            prioridade  =  {$tarefa['prioridade']},
            prazo       = '{$tarefa['prazo']}',
            concluida   =  {$tarefa['concluida']}
        WHERE id = {$tarefa['id']}
    ";

    mysqli_query( $conexao, $sqlEditar );
}

function remover_tarefa( $conexao, $id )
{
    $sqlRemover = "DELETE FROM tarefas WHERE id = {$id}";

    mysqli_query( $conexao, $sqlRemover );
}