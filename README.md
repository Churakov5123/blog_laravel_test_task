
Лента новостей.

Задача: разработать личный кабинет администратора новостного портала и ленту новостей.

Функционал:
1. Публичная часть:
• Лента новостей.

    2. Административная часть:
    • Вход в кабинет. Формы регистрации и входа;
    • Список новостей;
    • Создание, редактирование, удаление новостей (новость должна содержать текст и изображение);
    • Отложенная публикация новости в общей ленте по времени.

Серверную часть написать на фреймворке Laravel.
Клиентская часть Nuxt.js + Bootstrap Vue.
База данных MySQL или PostgreSQL.
Дизайн и верстка не принципиальны.

Код разместить в публичном репозитории.
____________________________________________________________________
Реализация:

Запуск и тестирование работы приложения:

- Запуск генерации пользователей-авторов:
  php artisan tinker
> > > factory( App\Models\User::class, 10)->create()

- Заполнение категориями:
  php artisan db:seed

- Запуск генерации статей для блога:
  php artisan tinker
> > > factory(App\Models\BlogPost::class, 300)->create()

Сделан CRUD постов и CRUD категорий блога - вынесены в админку.

На лицевую сторону выведен список статей и их просмотр, реализованна
отложенная публикация статей. 

Запуск : php artisan publishing-posts

Упор в работе делался на бэк часть. Если было бы больше времени, то сделал бы фронт на vue.js .

TO_DO: 
Можно вынести весь функционал блога в отдельный модуль.
Можно перенести фронт на vue js.
