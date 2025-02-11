<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Bem-vindo ao Cantinho da Josi!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Estilos gerais */
        body {
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
            color: #333;
        }
        .container {
            width: 100%;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .email-content {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .header {
            background-color: #ffcccc;
            padding: 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            color: #333;
        }
        .body {
            padding: 20px;
            font-size: 16px;
            line-height: 1.6;
        }
        .code-container {
            text-align: center;
            margin: 30px 0;
        }
        .code {
            display: inline-block;
            background-color: #f0f0f0;
            padding: 15px 30px;
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 4px;
            border-radius: 5px;
            color: #000;
        }
        .footer {
            background-color: #ffcccc;
            padding: 10px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body style="margin:0; padding:0; background-color:#f5f5f5;">
    <div class="container">
        <table class="email-content" width="600" border="0" cellspacing="0" cellpadding="0" align="center" style="border-collapse: collapse; background-color: #ffffff;">
            <tr>
                <td class="header" style="background-color:#ffcccc; padding:20px; text-align:center;">
                    <h1 style="margin:0; font-size:28px; color:#333;">Bem-vindo ao Cantinho da Josi!</h1>
                </td>
            </tr>
            <tr>
                <td class="body" style="padding:20px; font-family: Arial, sans-serif; font-size:16px; line-height:1.6; color:#333;">
                    <!-- Saudação personalizada conforme a dica -->
                    <p>Bem vindo, {{ $user->name }}!</p>
                    <p>Seu cadastro foi realizado com sucesso.</p>
                    
                    <p>Para completar seu cadastro e aumentar a segurança, utilize o código abaixo para autenticação de dois fatores:</p>
                    <div class="code-container" style="text-align:center; margin:30px 0;">
                        <span class="code" style="display:inline-block; background-color:#f0f0f0; padding:15px 30px; font-size:24px; font-weight:bold; letter-spacing:4px; border-radius:5px; color:#000;">
                            {{ $codigo }}
                        </span>
                    </div>
                    <p>O código é válido por 10 minutos. Caso não tenha solicitado esta ação, por favor, desconsidere este email.</p>
                    <p>Se precisar de suporte, nossa equipe está à disposição para ajudar.</p>
                    <p>Atenciosamente,<br>A equipe do Cantinho da Josi</p>
                </td>
            </tr>
            <tr>
                <td class="footer" style="background-color:#ffcccc; padding:10px; text-align:center; font-size:12px; color:#777;">
                    <p>Cantinho da Josi - Todos os direitos reservados</p>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
