# GSpreadSheet

Библиотека для работы с Google Spreadsheets с использованием <b>Service Account Credentials</b>.

## Установка

1. Клонируйте репозиторий:
   ```bash
   git clone https://github.com/vdenejhnev/gspreadsheet.git
   cd gspreadsheet
2. Установите зависимости с помощью Composer:
    ```bash
    composer install
3. Получите файл учетных данных сервисного аккаунта `service-account.json` из Google Cloud Console, а также идентификатор таблицы `your-spreadsheet-id`.
4. При инициализации объекта класса <b>GSpreadSheet\Sheet</b> в качестве параметров конструктора передайте путь к файлу учетных данных сервисного аккаунта `service-account.json` и идентификатор таблицы `your-spreadsheet-id`.

## Функционал

- Добавление значений в указаном диапазоне.
- Вывод содержимого из указанного диапазона.
- Обновление значений в указанном диапазоне.
- Очищение содержимого из указанного диапазона.


## Пример кода

Пример кода представлен в файле <b>example.php</b>.

## Контакты

Если у вас есть вопросы или предложения, вы можете связаться со мной slavikgolos@gmail.com

## Лицензия

Этот проект лицензирован под MIT License. См. файл <b>LICENSE</b> для получения дополнительной информации.
