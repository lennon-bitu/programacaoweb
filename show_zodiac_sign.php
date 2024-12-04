<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado do Signo</title>
    <!-- Link do CSS do Bootstrap -->
    <?php include('layouts/header.php'); ?>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="result-container">
        <?php
        // Verifica se o parâmetro 'date' foi enviado via POST
        if (!isset($_POST['date'])) {
            echo "<h1>Erro</h1>";
            echo "<p>Por favor, forneça uma data válida.</p>";
            exit;
        }

        // Obtém a data do formulário
        $userDate = DateTime::createFromFormat('Y-m-d', $_POST['date']);
        if (!$userDate) {
            echo "<h1>Erro</h1>";
            echo "<p>Data inválida.</p>";
            exit;
        }

        // Converte para dia e mês no formato DD/MM
        $dayMonth = $userDate->format('d/m');

        // Carrega o arquivo XML
        $xmlFile = 'signos.xml'; // Certifique-se de que o arquivo XML esteja na mesma pasta
        if (!file_exists($xmlFile)) {
            echo "<h1>Erro</h1>";
            echo "<p>Arquivo XML não encontrado.</p>";
            exit;
        }

        $xml = simplexml_load_file($xmlFile);

        // Busca o signo correspondente
        $signoEncontrado = null;
        foreach ($xml->signo as $signo) {
            $startDate = DateTime::createFromFormat('d/m', (string) $signo->dataInicio);
            $endDate = DateTime::createFromFormat('d/m', (string) $signo->dataFim);

            // Ajusta o ano para lidar com intervalos de signos que passam por dois anos (ex.: Capricórnio)
            if ($endDate < $startDate) {
                $endDate->modify('+1 year');
            }

            $currentDate = DateTime::createFromFormat('d/m', $dayMonth);
            if ($currentDate >= $startDate && $currentDate <= $endDate) {
                $signoEncontrado = $signo;
                break;
            }
        }

        // Exibe o resultado
        if ($signoEncontrado) {
            echo "<h1>Seu Signo é: " . $signoEncontrado->signoNome . "</h1>";
            echo "<p><strong>Período:</strong> " . $signoEncontrado->dataInicio . " a " . $signoEncontrado->dataFim . "</p>";
            echo "<p><strong>Descrição:</strong> " . $signoEncontrado->descricao . "</p>";
        } else {
            echo "<h1>Erro</h1>";
            echo "<p>Não foi possível determinar o signo para a data fornecida.</p>";
        }
        ?>
    </div>

    <!-- Link do JavaScript do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
