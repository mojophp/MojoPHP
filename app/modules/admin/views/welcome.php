<!DOCTYPE html>
<html>
    <head>
        <title>:: Mojo* PHP - Adminstração::</title>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <style>
            body {
                font-family: geneva, helvetica, verdana;
                font-size: 12px;
                color: #fff;
                background-color: #330066;
            }
            code {
                font-family: Consolas, Monaco, Courier New, Courier, monospace;
                font-size: 12px;
                background-color: #f9f9f9;
                border: 1px dotted #D0D0D0;
                color: #002166;
                display: block;
                margin: 14px 0 10px 0;
                padding: 12px 10px 12px 10px;
            }
            a {
                color: #003399;
                background-color: transparent;
                font-weight: normal;
            }
            #message {
                font-family: geneva, helvetica, verdana;
                font-size: 12px;
                color: #660099;

                width: 780px;
                /*                height: 220px;*/
                position: relative;
                margin-left: -390px;
                left: 50%;
                margin-top: 20px;
                padding: 20px;
                background-color: #fff;
            }
            #message h1 {
                font-family: geneva, helvetica, verdana;
                font-size: 18px;
                color: #660099;

                margin: 0px;
                padding-bottom: 10px;
                border-bottom: dotted #660099 1px;
            }
            #copy {
                font-family: geneva, helvetica, verdana;
                font-size: 12px;
                color: #fff;
                text-align: center;
                
                margin-top: 10px;
            }
        </style>
    </head>
    <body>
        <div id="message">
            <h1>Seja bem vindo ao Mojo<font color="#cc9900">*</font> PHP - Administração</h1>
            <p>A página que você está vizualizando foi gerada dinamicamente pelo Mojo* PHP.</p>
            <p>Se você quiser alterar esta página, poderá fazê-lo alterando o arquivo:</p>
            <code>/app/admin/views/welcome.php</code>
            <p>O controlador correspondente a esta página é o arquivo:</p>
            <code>/app/admin/controllers/indexController.php</code>
            <p>Se você está iniciando agora no Mojo* PHP, talvez queira começar lendo o <a href="user_guide">Guia do usuário</a>.</p>
        </div>
        <div id="copy">&copy;<?= date("Y"); ?> Mojo* PHP.</div>
    </body>
</html>
<!-- Administração -->