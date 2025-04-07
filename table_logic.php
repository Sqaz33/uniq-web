<?php
// Подключение к базе данных
$host = 'localhost';
$dbname = 'web';
$username = 'root';
$password = '';

$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Получаем список регионов для выпадающего списка
$regions = $pdo->query("SELECT id, name FROM regions")->fetchAll(PDO::FETCH_ASSOC);


// Функции валидации
function validateNumber($value): ?float
{
    if ($value === '') return null;
// Удаляем пробелы и заменяем запятые на точки
    $cleaned = str_replace([' ', ','], ['', '.'], $value);
// Проверяем, является ли числом
    if (!is_numeric($cleaned)) {
        return null;
    }
    return (float)$cleaned;
}

function sanitizeText($text): array|string
{
// Удаляем HTML/XML теги
    $cleaned = strip_tags($text);
// Экранируем специальные символы SQL
    return str_replace(
        ['\\', '\'', '"', "\0", "\n", "\r", "\x1a"],
        ['\\\\', '\\\'', '\\"', '\\0', '\\n', '\\r', '\\Z'],
        $cleaned
    );
}


// Получаем параметры фильтрации из GET-запроса
$nameFilter = isset($_GET['name']) ? sanitizeText($_GET['name']) : '';
$regionFilter = isset($_GET['region']) ? (int)$_GET['region'] : 0;
$descriptionFilter = isset($_GET['description']) ? sanitizeText($_GET['description']) : '';
$productionFilter = isset($_GET['production']) ? validateNumber($_GET['production']) : null;


// Формируем базовый SQL запрос
$sql = "SELECT e.id, e.facade_photo, e.name, r.name as region_name, e.description, e.production, e.region_Id
FROM enterprises e
INNER JOIN regions r ON e.region_Id = r.id";

// Добавляем условия WHERE в зависимости от заполненных фильтров
$whereConditions = [];
$params = [];

if (!empty($nameFilter)) {
    $whereConditions[] = "e.name LIKE :name";
    $params[':name'] = '%' . $nameFilter . '%';
}

if (!empty($regionFilter)) {
    $whereConditions[] = "e.region_Id = :region";
    $params[':region'] = $regionFilter;
}

if (!empty($descriptionFilter)) {
    $whereConditions[] = "e.description LIKE :description";
    $params[':description'] = '%' . $descriptionFilter . '%';
}

if (!empty($productionFilter)) {
    $whereConditions[] = "e.production = :production";
    $params[':production'] = str_replace([' ', ','], ['', '.'], $productionFilter);
}

// Добавляем условия WHERE к запросу, если они есть
if (!empty($whereConditions)) {
    $sql .= " WHERE " . implode(" AND ", $whereConditions);
}

$sql .= " ORDER BY e.production DESC";

// Подготавливаем и выполняем запрос
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$enterprises = $stmt->fetchAll(PDO::FETCH_ASSOC);
