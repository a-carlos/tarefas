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

function tratar_anexo($anexo)
{
    $padrao = '/^.+(\.pdf|\.zip)$/';

    $resultado = preg_match($padrao, $anexo['name']);

    if($resultado == 0)
    {
        return false;
    }

    move_uploaded_file($anexo['tmp_name'], "anexos/{$anexo['name']}");

    return true;
}

function enviar_email($tarefa, $anexos = [])
{

    include "bibliotecas/PHPMailer/PHPMailerAutoload.php";

    $corpo = preparar_corpo_email($tarefa);
    //  Acessar o servidor de e-mails;
    //  Fazer a autenticação com usuário e senha;
    //  Usar a opção para escrever um e-mail;
    $email = new PHPMailer(); //esta é a crciação do objeto

    $email->isSMTP();
    $email->Host        = "smtp.gmail.com";
    $email->Port        = 587;
    $email->SMTPSecure  = 'tls';
    $email->SMTPAuth    = true;
    $email->Username    = "c4rlos.sp@gmail.com";
    $email->Password    = "";
    $email->setFrom("c4rlos.sp@gmail.com", "Avisador de Tarefas");

    //  Digitar o e-mail do destinatário;
    $email->addAddress(EMAIL_NOTIFICACAO);

    //  Digitar o assunto do e-mail;
    $email->subject = "Aviso de tarefa: {$tarefa->getNome()}";

    //  Escrever o corpo do e-mail;
    $email->msgHTML($corpo);

    //  Adicionar os anexos, quando necessário;
    foreach ($tarefa->getAnexos() as $anexo) {
        $email->addAttachment("anexos/{$anexo->getArquivo()}");
    }

    //  Usar a opção de enviar o e-mail.
    if(!$email->send()){
        gravar_log($email->ErrorInfo);
    }
}

function preparar_corpo_email(Tarefa $anexo)
{


    //Aqui vamos pegar o conteúdo processado do arquivo template_email.php

    //Falar pro PHP que não é pra enviar o resultado do processamento para o navegador:

    ob_start();

    //incluir o arquivo template_email.php
    include "template_email.php";

    //guardar o conteúdo do arquivo em uma variável;
    $corpo = ob_get_contents();

    //falar para o PHP que ele pode voltar a mandar conteúdos para o navegador
    ob_end_clean();

    return $corpo;

}

function montar_email() {
    $tem_anexos = '';

    if (count($anexos) > 0) {
        $tem_anexos = "<p><strong>Atenção!</strong> Esta tarefa contém anexos!</p>";
    }

    $corpo = "
        <html>
            <head>
                <meta charset=\"utf-8\" />
                <title>Gerenciador de Tarefas</title>
                <link rel=\"stylesheet\" href=\"tarefas.css\" type=\"text/css\" />
            </head>
            <body>
                <h1>Tarefa: {$tarefa['nome']}</h1>

                <p><strong>Concluída:</strong> " . traduz_concluida($tarefa['concluida']) . "</p>
                <p><strong>Descrição:</strong> " . nl2br($tarefa['descricao']) . "</p>
                <p><strong>Prazo:</strong> " . traduz_data_para_exibir($tarefa['prazo']) . "</p>
                <p><strong>Prioridade:</strong> " . traduz_prioridade($tarefa['prioridade']) . "</p>

                {$tem_anexos}

            </body>
        </html>
    ";
}


function gravar_log($mensagem)
{
    $datahora = date("Y-m-d H:i:s");
    $mensagem = "{$datahora} {$mensagem}\n";

    file_put_contents("mensagens.log", $mensagem, FILE_APPEND);
}

function traduz_data_br_para_objeto($data)
{
    if($data == ""){
        return "";
    }

    $dados = explode("/", $data);

    if(count($dados) != 3){
        return $data;
    }

    return DateTime::createFromFormat('d/M/Y', $data);
}