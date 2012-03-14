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
            <h1>Mojo* PHP</h1>
            <p><b>Erro!</b></p>
            <code><?=$error_message;?></code>
        </div>
        <div id="copy">&copy;<?=date("Y");?> Mojo* PHP.</div>
    </body>
</html>
