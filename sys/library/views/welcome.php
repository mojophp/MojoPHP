<!DOCTYPE html>
<html>
    <head>
        <title>:: Mojo* PHP ::</title>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <style>
            body {
                font-family: geneva, helvetica, verdana;
                font-size: 12px;
                color: #fff;
                background-color: #660099;
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
            <h1>Seja bem vindo ao Mojo* PHP</h1>
            <p>A página que você está vizualizando foi gerada dinamicamente pelo Mojo* PHP.</p>
            <p>Se vcê quiser alterar esta página, poderá fazê-lo alterando o arquivo:</p>
            <code>/app/views/welcome.php</code>
            <p>O controlador correspondente a esta página é o arquivo:</p>
            <code>/app/controllers/indexController.php</code>
            <p>Se você está iniciando agora no Mojo* PHP, talvez queira começar lendo o Guia do usuário.</p>
        </div>
        <div id="copy">&copy;<?= date("Y"); ?> Mojo* PHP.</div>
    </body>
</html>
