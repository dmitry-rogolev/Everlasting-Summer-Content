## Установка composer на Ubuntu

1. Скачайте composer.phar

        php -r "readfile('https://getcomposer.org/installer');" | php

2. Переместите файл composer.phar в каталог /usr/local/bin/composer 

        mv composer.phar /usr/local/bin/composer
    
3. Проверте работу composer командой

        composer --version