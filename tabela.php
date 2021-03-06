<table>
    <tr>
        <th>Tarefa</th>
        <th>Descricao</th>
        <th>Prazo</th>
        <th>Prioridade</th>
        <th>Concluída</th>
        <th>Opções</th>

    </tr>

    <?php foreach($tarefas as $tarefa) : ?>
        <tr>
            <td>
                <a href="tarefa.php?id=<?php echo $tarefa->getId(); ?>">
                    <?php echo htmlentities($tarefa->getNome()); ?>
                </a>
            </td>
            <td><?php echo htmlentities($tarefa->getDescricao()); ?></td>
            <td align="center"><?php echo traduz_data_para_exibir($tarefa->getPrazo()); ?></td>
            <td align="center"><?php echo traduz_prioridade($tarefa->getPrioridade()); ?></td>
            <td align="center"><?php echo traduz_concluida($tarefa->getConcluida()); ?></td>
            <td align="center">
                <a href="editar.php?id=<?php echo $tarefa->getId(); ?>">Editar</a>
                <a href="remover.php?id=<?php echo $tarefa->getId(); ?>">Remover</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>