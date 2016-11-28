<?php
    $tarefa =[
        'nome'  =>  'Comprar    Cebolas',
        'prioridade'    =>  'urgente',
    ];

    if  (isset($tarefa['prioridade']))  {
        echo 'A  tarefa  tem uma prioridade  definida'.'</br>';
    }
    else
    {
        echo 'A  tarefa  NÃO tem uma prioridade  definida'.'</br>';
    }

    if  (isset($pessoa))
    {
        echo    'A  variável    $pessoa foi definida'.'</br>';
    }
    else
    {
        echo    'A  variável    $pessoa NÃO foi definida'.'</br>';
    }
