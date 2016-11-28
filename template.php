<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <title>Gerenciador de Tarefas</title>

        <link rel="stylesheet" href="tarefas.css" type="text/css" />
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    </head>
    <body>
        <h1>Gerenciador de Tarefas</h1>
        <div class="container">

            <div>
            <?php require 'formulario.php'; ?>
            </div>

            <div>
            <?php if ( $exibir_tabela ) : ?>
                <?php require 'tabela.php'; ?>
            <?php endif; ?>
            </div>
        </div>

    <link rel="stylesheet" type="text/css" href="bootstrap.min.js">
    </body>
</html>