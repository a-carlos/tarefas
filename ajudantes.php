<?php

#pega a data informada e muda para o padrão mysql a-d-m
function traduz_data_para_banco( $data )
{
    if ( $data == "" ){
        return "";
    }

    $partes = explode("/", $data);

    if (count($partes) != 3){
        return $data;
    }

    $objeto_data = DateTime::createFromFormat('d/m/Y', $data);

    return $objeto_data->format('Y-m-d');
}

#pega a data do padrão sql e exibe no formato brasil d-m-a
function traduz_data_para_exibir( $data )
{
    if( $data == "" OR $data == "0000-00-00" ){
        return "";
    }

    $partes = explode("-", $data);

    if (count($partes) != 3){
        return $data;
    }

    $objeto_data = DateTime::createFromFormat('Y-m-d', $data);

    return $objeto_data->format('d/m/Y');
}

function validar_data($data)
{
    $padrao = '/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/';

    //
    $resultado = preg_match( $padrao, $data );

    if ($resultado == 0){
        return false;
    }

    $dados = explode('/', $data);

    $dia = $dados[0];
    $mes = $dados[1];
    $ano = $dados[2];

    $resultado = checkdate($mes, $dia, $ano);

    return $resultado;
}

function traduz_prioridade( $codigo )
{
    $prioridade = '';

    switch ( $codigo ) {
        case '1':
            $prioridade = 'Baixa';
            break;

        case '2':
            $prioridade = 'Média';
            break;

        case '3':
            $prioridade = 'Alta';
            break;
    }

    return $prioridade;
}

function traduz_concluida( $concluida )
{
    if ( $concluida == 1 ) {
        return 'Sim';
    }

    return 'Não';
}

function tem_post()
{
    if ( count($_POST) > 0 )
    {
        return true;
    }

    return false;
}