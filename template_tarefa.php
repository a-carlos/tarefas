<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Gerenciador de Tarefas</title>
    <link rel="stylesheet" href="tarefas.css" type="text/css"/>
</head>
<body>
    <div="bloco_principal">
        <h1>Tarefa: <?php echo htmlentities($tarefa->getNome()); ?> </h1>

        <p><a href="tarefas.php"> Voltar para lista de tarefas</a>.</p>

        <p><strong>Concluída:</strong><?php echo traduz_concluida($tarefa->getConcluida()); ?></p>
        <p><strong>Descrição:</strong><?php echo nl2br(htmlentities($tarefa->getDescricao())); ?></p>
        <p><strong>Prazo:</strong><?php echo traduz_data_para_exibir($tarefa->getPrazo()); ?></p>
        <p><strong>Prioridade:</strong><?php echo traduz_prioridade($tarefa->getPrioridade()); ?></p>

        <h2>Anexos</h2>
        <!-- Lista de anexos -->
        <?php if(count($tarefa->getAnexos()) > 0) : ?>
            <table>
                <tr>
                    <th>Arquivo</th>
                    <th>Opções</th>
                </tr>

                <?php foreach($tarefa->getAnexos() as $anexo) : ?>
                    <tr>
                        <td><?php echo htmlentities($anexo->getNome()); ?></td>

                        <td>
                            <a href="anexos/<?php $anexo->getArquivo(); ?>">Download</a>
                            <a href="remover_anexo.php?id=<?php echo $anexo->getId(); ?>">Remover</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>Não há anexos para esta tarefa.</p>
        <?php endif; ?>


        <!-- Formulário para um novo anexo -->
        <!--
            a propriedade enctype="multipart/form-data", que serve
            para indicar para o navegador que nosso formulário
            vai fazer o envio de arquivos
        <--></-->
        <form action="" method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend>Novo Anexo</legend>
                <input type="hidden" name="tarefa_id" value="<?php echo $tarefa->getId(); ?>" />

                <label>
                    <?php if($tem_erros && isset($erros_validacao['anexo'])): ?>

                        <span class="erro"><?php echo $erros_validacao['anexo']; ?></span>
                    <?php endif; ?>

                    <input type="file" name="anexo">
                </label>

                <input type="submit" value="Cadastrar" >
            </fieldset>
        </form>
    </div>
</body>
</html>