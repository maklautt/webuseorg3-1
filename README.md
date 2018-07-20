# Учёт оргтехники в организации v3.X 2011-2016


Система предназначена для учёта оргтехники в небольших организациях и будет полезна в основном инженерам IT отдела, ведущими учёт без фанатизма.

Домашняя страница проекта: <a href="http://xn--90acbu5aj5f.xn--p1ai/?page_id=1202" target="_blank">http://грибовы.рф/?page_id=1202</a>

DEMO: [http://demo.грибовы.рф](http://demo.xn--90acbu5aj5f.xn--p1ai)  
Логин: `test`  
Пароль: `test`  
База обнуляется раз в час.

Wiki: [http://грибовы.рф/wiki/doku.php/start](http://xn--90acbu5aj5f.xn--p1ai/wiki/doku.php/start)

Любые вопросы:  
Skype: `pvtuning`  
ICQ: `207074753`

### ВНИМАНИЕ

Для стабильной работы рекомендую устанавливать релизы, а не "свежатинку"
https://github.com/donpadlo/webuseorg3/releases


### Требования
1. Apache 2
  - mod_rewrite
2. PHP 5
  - extension=php_mysqli.dll
3. MySQL или MariaDB

### Установка

1. Запустить инсталлятор _http://адрессайта/install.php_
2. Переименовать файл `config.php.dist` в `config.php` и отредактировать.
3. Поправить права на папки `files`, `photo`, `maps` на 0777
4. На всякий случай выполнить http://адрессайта/update.php_
5. Удалить инсталлятор  _http://адрессайта/install.php_

Если используете пакет "Денвер", то необходимо в `httpd.conf` изменить кодироку по умолчанию: 
`AddDefaultCharset utf-8`  
Так-же при отображении "кракозябров", возможно стоит поменять кодировку в файле `config.php`. Например `$codemysql = 'utf8-bin';` или `$codemysql = 'utf8_general_ci';`

### Обновление

Обновления являются куммулятивными — для обновления до последней версии нужен только самый последний релиз.

1. Скачать ПОСЛЕДНЮЮ версию данного ПО.
2. Копировать её 1 в 1 с заменой файлов в каталог с предыдущей версией (за исключением `config.php` в корне).
3. Открыть в браузере _http://адрессайта/update.php_

Не забудьте после обновления удалить файл `update.php`
