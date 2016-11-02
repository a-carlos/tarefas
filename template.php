<?php session_start()?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <title>Gerenciador de Tarefas</title>

        <link rel="stylesheet" href="assets/css/tarefas.css" type="text/css">
    </head>
    <body>
        <h1>Gerenciador de Tarefas</h1>

        <form>
            <fieldset>
                <legend>Nova tarefa</legend>
                <label>
                    Tarefa:
                    <input type="text" name="nome">
                </label>

                <label>
                    Descrição (Opcional):
                    <textarea name="descricao"></textarea>
                </label>

                <label>
                    Prazo (opcional):
                    <input type="text" name="prazo">
                </label>

                <fieldset>
                    <legend>Prioridade:</legend>
                    <label>
                        <input type="radio" name="prioridade" value="baixa" checked>Baixa

                        <input type="radio" name="prioridade" value="media">Média

                        <input type="radio" name="prioridade" value="alta">Alta
                    </label>
                </fieldset>

                <label>
                    Tarefa Concluída:
                    <input type="checkbox" name="concluida" value="sim">
                </label>

                <input type="submit" value="Cadastrar">
            </fieldset>
        </form>


        <table>
            <tr>
                <th>Tarefas</th>
            </tr>

            <?php foreach($lista_tarefas as $tarefa) : ?>
                <tr>
                   <td><?php echo $tarefa; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

    </body>
</html>