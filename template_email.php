<h1>Tarefa: <?php echo $tarefa->getNome(); ?></h1>

<p>
    <strong>Concluída:</strong>
    <?php echo traduz_concluida($tarefa->getConcluida());  ?>
</p>

<p>
    <strong>Descriçaõ:</strong>
    <?php echo nl2br($tarefa->getDescricao()); ?>
</p>

<p>
    <strong>Prazo:</strong>
    <?php echo traduz_data_para_exibir($tarefa->getPrazo()); ?>
</p>

<p>
    <strong>PRioridade:</strong>
    <?php echo traduz_prioridade($tarefa->getPrioridade()); ?>
</p>

<?php if(count($tarefa->getAnexos()) > 0) : ?>
    <p><strong>Atenção!</strong>Esta tarefa contém anexos!</p>
<?php endif; ?>

<p>
    Tenha um bom dia.
</p>