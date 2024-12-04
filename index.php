<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descubra seu Signo</title>
    <?php include('layouts/header.php'); ?>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        
    </style>
</head>
<body>
    <div class="signo-form">
        <h2>Descubra seu Signo</h2>
        <form action="show_zodiac_sign.php" method="POST">
            <div class="mb-3">
                <label for="date" class="form-label">Informe a data de nascimento:</label>
                <input type="date" id="date" name="date" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-light w-100">Buscar</button>
        </form>
    </div>

    <!-- Link do JavaScript do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
