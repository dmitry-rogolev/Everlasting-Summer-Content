## Добавление php в переменную PATH на Ubuntu

1. Откройте файл .bashrc в nano 

        nano ~/.bashrc

2. Добавьте в конец файла 

        export PATH=$PATH:/opt/lampp/bin

3. Нажмите Ctrl+O, чтобы записать изменения в файл

4. Нажмите Ctrl+X для выхода из nano

5. Обновите переменные окружения

        source ~/.bashrc

6. Проверьте работу php 

        php --version