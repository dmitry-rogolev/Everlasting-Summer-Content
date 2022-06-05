## Установка git на Ubuntu

1. Установите git 

        sudo spt install git

2. Укажите имя пользователя

        git config --global user.name "Ваше имя"

3. Укажите электронную почту пользователя

        git config --global user.email "example@email.com"

4. Установите параметры окончания строк

        git config --global core.autocrlf input 

        git config --global core.safecrlf warn

5. Установите отображение Unicode

        git config --global core.quotepath off