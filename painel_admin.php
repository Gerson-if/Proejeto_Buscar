<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel Admin</title>
    <link rel="stylesheet" href="css/admin.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            overflow: hidden;
            background-color: #f8f8f8; /* Set a light background color */
        }

        #navbar {
            background-color: #333;
            overflow: hidden;
        }

        #navbar a {
            float: left;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        #navbar a:hover {
            background-color: #ddd;
            color: black;
        }

        #navbar a.active {
            background-color: #4CAF50;
            color: white;
        }

        #content {
            padding: 16px;
            text-align: center;
            position: relative;
        }

        #footer {
            position: fixed;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px;
            width: 100%;
        }

        .slides-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
        }

        .slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        .slide.active {
            opacity: 1;
            z-index: 1; /* Ensure the active slide is on top */
        }

        .slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>
<body>

    <div id="navbar">
        <a href="adicionar_registro.php">Adicionar Novo Registro</a>
        <a href="pesquisar_registros.php">Pesquisar Registros</a>
        <a href="logout.php">Sair</a>
    </div>

    <div id="content">
        <h2>Bem-vindo, Administrador</h2>
    </div>

    <div id="footer">
        <!-- Rodapé vai aqui -->
        <p> versao 2.0 de 2024</p>
    </div>

    <div class="slides-container">
        <div class="slide active">
            <img src="imagens/agata_2.jpeg" alt="Slide 1">
        </div>
        <div class="slide">
            <img src="imagens/agata_1.jpeg" alt="Slide 2">
        </div>
        <!-- Adicione mais slides conforme necessário -->
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var slides = document.querySelectorAll('.slide');
            var currentSlide = 0;

            function showSlide(index) {
                slides[currentSlide].classList.remove('active');
                currentSlide = (index + slides.length) % slides.length;
                slides[currentSlide].classList.add('active');
            }

            setInterval(function () {
                showSlide(currentSlide + 1);
            }, 5000); // Altere o intervalo conforme necessário
        });
    </script>
</body>
</html>
