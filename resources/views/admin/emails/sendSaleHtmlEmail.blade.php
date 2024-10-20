<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Celke</title>
</head>

<body>

    <p>Prezado (a), {{ $sale->customer->name }},</p>

    Você comprou em nossa loja. Acesse nesse o link para ver os detalhes da compra: <a href="http://localhost:5173/results.html?code_sale={{$sale->code_sale}}">Detalhes da Compra</a>

    <p>Atenciosamente, Equipe SGV</p>

</body>

</html>
