Yii 2 Rest Starter Kit
============================

# Install:

Clone or composer create-project --prefer-dist --stability=dev rex-it/yii2-rest-starter-kit


1) Скопировать .env.dist в .env и ввести нужные данные.

2) Запустить команду: php yii app/setup (это создаст нового пользователя)

3) Enjoy!


# Как устроено:

Стандартный шаблон модуля API с версионированием.

Роуты хранятся в config/routes.php

Кастомный ErrorHandler

ContentNegotiator с поддержкой мультиязычности и ограничение форматов до двух: json, xml

В V1 components реализованы родительские классы для Rest Controller и Active Controller с требованием авторизации в behaviors.
