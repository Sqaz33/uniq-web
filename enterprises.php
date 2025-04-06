<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Комплект Сервис - Предприятия</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/bootstrap-icons-1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/table.css">
</head>

<body>
<header class="container py-3">
    <div class="row align-items-center">
        <div class="col-md-3 d-flex align-items-center">
            <a href="/">
                <img src="img/logo.png" alt="Логотип">
            </a>
        </div>
        <div class="col-md-3 d-flex align-items-center">
            <i class="bi bi-geo-alt"></i>
            <p class="mb-0 ms-2"><strong>Как нас найти:</strong><br>г. Воронеж, ул. Брянская, 87</p>
        </div>
        <div class="col-md-3 d-flex align-items-center">
            <i class="bi bi-telephone"></i>
            <p class="mb-0 ms-2"><strong>Телефон:</strong><br><a href="tel:+74732584417">+7 (473) 258-44-17</a></p>
        </div>
        <div class="col-md-3 d-flex align-items-center justify-content-between">
            <div>
                <i class="bi bi-envelope"></i>
                <p class="mb-0 ms-2 d-inline-block"><strong>Email:</strong><br><a
                            href="mailto:komplekt-servis01@yandex.ru">komplekt-servis01@yandex.ru</a></p>
            </div>
            <a href="#" class="search-icon border p-2 d-inline-block">
                <i class="bi bi-search"></i>
            </a>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mt-3">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="https://komplekt-serv.ru/">Главная</a></li>
                    <li class="nav-item"><a class="nav-link" href="https://komplekt-serv.ru/o-kompanii/">О
                            компании</a></li>
                    <li class="nav-item"><a class="nav-link" href="https://komplekt-serv.ru/katalog/">Каталог</a>
                    </li>
                    <li class="nav-item"><a class="nav-link"
                                            href="https://komplekt-serv.ru/category/proizvodstvo/">Производство</a></li>
                    <li class="nav-item"><a class="nav-link"
                                            href="https://komplekt-serv.ru/category/stati/">Статьи</a></li>
                    <li class="nav-item"><a class="nav-link" href="https://komplekt-serv.ru/kontakty/">Контакты</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<main class="container my-4">
    <h1 class="mb-4">Наши предприятия</h1>

    <?php
    // Подключение к базе данных
    $host = 'localhost';
    $dbname = 'web';
    $username = 'root';
    $password = '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // SQL запрос с JOIN для получения данных из обеих таблиц
        $sql = "SELECT e.id, e.facade_photo, e.name, r.name as region_name, e.description, e.production, e.region_Id
                    FROM enterprises e 
                    INNER JOIN regions r ON e.region_Id = r.id 
                    ORDER BY e.production DESC";

        $stmt = $pdo->query($sql);

        if ($stmt->rowCount() > 0) {
            echo '<div class="table-responsive">
                    <table class="enterprises-table">
                        <thead>
                            <tr>
                                <th>Фото фасада</th>
                                <th>Название</th>
                                <th>Регион</th>
                                <th>Описание</th>
                                <th>Выработка в год (руб.)</th>
                            </tr>
                        </thead>
                        <tbody>';

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Форматируем сумму выработки
                $productionFormatted = number_format($row['production'], 2, ',', ' ');

                echo '<tr>
                            <td><img src="facade_images/' . htmlspecialchars($row['facade_photo']) . '" alt="Фасад ' . htmlspecialchars($row['name']) . '" class="enterprise-image"></td>
                            <td>' . htmlspecialchars($row['name']) . '</td>
                            <td>' . htmlspecialchars($row['region_name']) . '</td>
                            <td>' . htmlspecialchars($row['description']) . '</td>
                            <td class="production-cell">' . $productionFormatted . '</td>
                        </tr>';
            }

            echo '</tbody>
                    </table>
                </div>';
        } else {
            echo '<div class="alert alert-info">Нет данных о предприятиях</div>';
        }
    } catch (PDOException $e) {
        echo '<div class="alert alert-danger">Ошибка при получении данных: ' . htmlspecialchars($e->getMessage()) . '</div>';
    }
    ?>

</main>


<footer>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mt-3">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="https://komplekt-serv.ru/">Главная</a></li>
                    <li class="nav-item"><a class="nav-link" href="https://komplekt-serv.ru/o-kompanii/">О
                            компании</a></li>
                    <li class="nav-item"><a class="nav-link" href="https://komplekt-serv.ru/katalog/">Каталог</a>
                    </li>
                    <li class="nav-item"><a class="nav-link"
                                            href="https://komplekt-serv.ru/category/proizvodstvo/">Производство</a></li>
                    <li class="nav-item"><a class="nav-link"
                                            href="https://komplekt-serv.ru/category/stati/">Статьи</a></li>
                    <li class="nav-item"><a class="nav-link" href="https://komplekt-serv.ru/kontakty/">Контакты</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="footer-container">
        <div class="footer-logo">
            <img src="img/logo.png" alt="Комплект Сервис">
            <p>КРЕПЕЖНЫЕ ИЗДЕЛИЯ</p>
        </div>
        <div class="footer-info">
            <div class="footer-contact">
                <i class="fas fa-phone"></i>
                <span>Контактный телефон:</span>
                <a href="tel:+74732584417">+7 (473) 258-44-17</a>
            </div>
            <div class="footer-location">
                <i class="fas fa-map-marker-alt"></i>
                <span>Как нас найти:</span>
                <p>г. Воронеж, ул. Брянская, 87</p>
            </div>
            <div class="footer-email">
                <i class="fas fa-envelope"></i>
                <span>E-mail:</span>
                <a href="mailto:komplekt-servis01@yandex.ru">komplekt-servis01@yandex.ru</a>
            </div>
        </div>
        <div class="footer-social">
            <a href="https://vk.com/"><img src="img/vk.png" alt="VK"></a>
            <a href="https://www.youtube.com/?gl=RU"><img src="img/youtube.png" alt="YouTube"></a>
            <a href="https://www.instagram.com/?hl=ru"><img src="img/instagram.png" alt="Instagram"></a>
        </div>
    </div>
</footer>

<script src="/js/bootstrap.bundle.min.js"></script>
</body>


</html>