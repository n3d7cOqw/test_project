Установка Laravel и зависимостей

cd test_project
composer install
./vendor/bin/sail up
npm install
npm run build
nvm install 20 // Если не сработала команда выше
php artisan migrate --seed
php artisan storage:link

Routes:
http://127.0.0.1:8000/comments
http://127.0.0.1:8000/register
http://127.0.0.1:8000/login
http://127.0.0.1:8000/dashboard


Для доступа к полному функционалу сайта нужно создать аккаунт, после этого по пути /comments 
можно будет читать, добавлять комментарии к тестовому посту. В форме для добавления комментария есть
капча которая реализована с помощью библиоткеки mewebstudio/captcha (https://github.com/mewebstudio/captcha)
c помощью библиотеки  Purifier (https://github.com/mewebstudio/Purifier) реализовал добавление тегов.
Сделал систему для добавления фото, но не пойму почему не отображаються фото у комментариев.
Комментарии могут добавлять только пользователи которые вошли в аккаунт, но читать комментарии могут все.



