<?php include 'table_logic.php'; ?>
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

    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="" class="row g-3">
                <div class="col-md-3">
                    <label for="name" class="form-label">Название</label>
                    <input type="text" class="form-control" id="name" name="name"
                           value="<?php echo htmlspecialchars($nameFilter); ?>" placeholder="Поиск по названию">
                </div>
                <div class="col-md-2">
                    <label for="region" class="form-label">Регион</label>
                    <select class="form-select" id="region" name="region">
                        <option value="">Все регионы</option>
                        <?php foreach ($regions as $region): ?>
                            <option
                                    value="<?= $region['id'] ?>"
                                <?= ($region['id'] == $regionFilter) ? 'selected' : '' ?>
                            >
                                <?= htmlspecialchars($region['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="description" class="form-label">Описание</label>
                    <input type="text" class="form-control" id="description" name="description"
                           value="<?php echo htmlspecialchars($descriptionFilter); ?>" placeholder="Поиск по описанию">
                </div>
                <div class="col-md-2">
                    <label for="production" class="form-label">Выработка</label>
                    <input type="text" class="form-control" id="production" name="production"
                           value="<?php echo htmlspecialchars($productionFilter); ?>" placeholder="Точное значение">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" name="apply_filter" class="btn btn-primary me-2">Применить фильтр</button>
                    <a href="?" class="btn btn-secondary">Сбросить</a>
                </div>
            </form>
        </div>
    </div>

    <?php if (count($enterprises) > 0): ?>
        <div class="table-responsive">
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
                <tbody>
                <?php foreach ($enterprises as $row): ?>
                    <?php $productionFormatted = number_format($row['production'], 2, ',', ' '); ?>
                    <tr class="region-<?php echo $row['region_Id']; ?>">
                        <td>
                            <img src="facade_images/<?php echo htmlspecialchars($row['facade_photo']); ?>"
                                 alt="Фасад <?php echo htmlspecialchars($row['name']); ?>"
                                 class="enterprise-image">
                        </td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['region_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['description']); ?></td>
                        <td class="production-cell"><?php echo $productionFormatted; ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-info">Нет данных о предприятиях, соответствующих заданным фильтрам</div>
    <?php endif; ?>
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