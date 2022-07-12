# Everlasting Summer Content

**Everlasting Summer Content** &mdash; проект, реализующий сбор контента из визуальной новеллы "Бесконечное лето". Сбор контента осуществляется как и из оригинальной версии игры (История одного пионера), так и из пользовательских модов.

Под контентом сдесь понимаются: музыка, спрайты, фоны, иллюстрации, звуки и прочее.

## Цель

1. Реализовать приложение, представляющее собой сборник контента из визуальной новеллы "Бесконечное лето".

## Задачи

1. <s>Разработать шаблон приложения</s>; 
2. <s>Реализовать авторизацию пользователей</s>;
3. <s>Реализовать роли пользователей</s>;
4. <s>Реализовать локализацию интерфейса</s>;
5. <s>Реализовать страницу профиля</s>;
6. <s>Реализовать страницу мой контент</s>;
7. <s>Заменить css на sass</s>;
8. <s>Реализовать добавление контента</s>;
9. <s>Реализовать вывод контента на странице "мой контент"</s>;
10. <s>Реализовать удаление контента</s>;
11. <s>Реализовать переименование контента</s>;
12. <s>Реализовать создание каталогов</s>;
13. <s>Реализовать удаление каталогов</s>;
14. <s>Реализовать переименование каталогов</s>;
15. <s>Реализовать множественную загрузку файлов</s>;
16. <s>Реализовать скачивание файлов</s>;
17. <s>Реализовать скачивание каталогов</s>;
18. <s>Реализовать прямой доступ к контенту</s>;
19. <s>Реализовать вывод контента на главной</s>;
20. <s>Реализовать сокрытие контента от других пользователей</s>;
21. <s>Реализовать нумерацию страниц</s>;
22. <s>Реализовать поиск контента</s>;
23. <s>Реализовать отображение информации о пользователе на странице профиля</s>;
24. <s>Добавить информацию о контенте на странице контента</s>;
25. <s>Реализовать добавление контента в понравившиеся</s>;
26. <s>Реализовать подсчет количества просмотров контента</s>;
27. <s>Реализовать подсчет количества скачиваний контента</s>;
28. <s>Реализовать добавление контента в избранное</s>;
29. Реализовать добавление комментариев к контенту;
30. Реализовать добавление комментариев в понравившиеся;
31. Реализовать сортировку контента;
32. Провести рефакторинг;
33. Протестировать приложение;
34. Задокументировать приложение;
35. Выпустить версию 1.0.0

## Текущая версия: 

## Автор

Роголев Дмитрий Александрович

## Контакты автора

Email: drogolev@internet.ru

Блог автора: https://rogolev.blog/

Вконтакте: https://vk.com/dmitryrogolev

## Перед установкой

Перед установкой вам необходимо иметь следующее программное обеспечение: 

1. Сервер и база данных;
2. git
3. composer
4. php

## Инструкция по установке

1. Клонируйте репозиторий 

        git clone https://github.com/dmitry-rogolev/Everlasting-Summer-Content.git 

2. Перейдите в каталог web

        cd web

3. Установите зависимости с помощью composer

        composer install

4. Создайте файл .env и скопируйте в него содержимое из файла .env.example в каталоге web

5. Файл .env - это файл конфигурации приложения. Измените необходимые константы по необходимости. 

6. Выполните миграцию таблиц в базу данных 

        php artisan migrate

7. Заполните таблицы необходимыми данными 

        php artisan db:seed

8. Запустите приложение 

        php artisan serve

## Перед работой 

Перед работой вам необходимо следующее программное обеспечение: 

1. npm
2. nodejs

## Инструкция по работе 

1. Перейдите в каталог web

        cd web

2. Запустите приложение 

        php artisan serve

3. Откройте новый терминал

4. Перейдите в каталог web

        cd web

5. Установите Laravel Mix

        npm install

5. Запустите компиляцию CSS и JavaScript

        npm run watch

6. Откройте новый терминал

7. Перейдите в каталог web

        cd web