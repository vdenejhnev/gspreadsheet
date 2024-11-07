<?php 

// Подключаем автозагрузчик классов (возможно использование альтернативного автозагрузчика классов)
require_once 'autoload.php'; 

$serviceAccountJSON = 'service-account.json'; // Путь к JSON-файлу с учетными данными сервисного аккаунта
$spreadsheetId = 'your-spreadsheet-id'; // Идентификатор таблицы (spreadsheet ID)

try {
    // Создаем объект таблицы с использованием учетных данных и идентификатора таблицы
    $spreadsheet = new GSpreadSheet\Sheet($serviceAccountJSON, $spreadsheetId);

    // Добавляем новую строку значений в диапазон A1:C1
    $spreadsheet->append(
        'sheet!A1:C1',
        [
            'value1', // Значение в ячейке A1
            'value2', // Значение в ячейке B1
            'value3'  // Значение в ячейке C1
        ]
    );

    // Выводим содержимое диапазона A1:C1
    print_r($spreadsheet->get('sheet!A1:C1'));

    // Обновляем значения в диапазоне A1:C1
    $spreadsheet->update(
        'sheet!A1:C1',
        [
            'value4', // Новое значение в ячейке A1
            'value5', // Новое значение в ячейке B1
            'value6'  // Новое значение в ячейке C1
        ]
    );

    // Очищаем содержимое диапазона A1:C1
    $spreadsheet->clear('sheet!A1:C1');
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}

?>