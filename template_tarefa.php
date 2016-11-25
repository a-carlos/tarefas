<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Gerenciador de Tarefas</title>
    <link rel="stylesheet" type="text/css" href="tarefas.css">
</head>
<body>
    <div="bloco_principal">
        <h1>Tarefa: <?php echo $tarefa['nome']; ?> </h1>

        <p><a href="tarefas.php"> Voltar para lista de tarefas</a></p>

        <p><strong>Concluída:</strong><?php echo traduz_concluida($tarefa['concluida']); ?></p>
        <p><strong>Descrição:</strong><?php echo nl2br($tarefa['descricao']); ?></p>
        <p><strong>Prazo:</strong><?php echo traduz_data_para_exibir($tarefa['prazo']); ?></p>
        <p><strong>Prioridade:</strong><?php echo traduz_prioridade($tarefa['prioridade']); ?></p>

        <h2>Anexos</h2>
        <!-- Lista de anexos -->
        <?php if(count($anexos) > 0) : ?>
            <table>
                <tr>
                    <th>Arquivo</th>
                    <th>Opções</th>
                </tr>

                <?php foreach($anexos as $anexo) : ?>
                    <tr>
                        <td><?php echo $anexo['nome']; ?></td>

                        <td>
                            <a href="anexos/<?php $anexo['arquivo']; ?>">Download</a>
                            <a href="remover_anexo.php?id=<?php echo $anexo['id']; ?>">Remover</a>
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
                <input type="hidden" name="tarefa_id" value="<?php echo $tarefa['id']; ?>" />

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