ПОСТЫ

1. Получить все посты
метод GET

http://api-auth/api/posts OK
http://blog.garrykhr.ru/api/posts OK


2. Получить пост по id
метод GET
1 - id

http://api-auth/api/posts/1 OK
http://blog.garrykhr.ru/api/posts/1 OK


3. Добавить пост
метод POST

http://api-auth/api/posts/add/title?title=test&text=test OK
http://blog.garrykhr.ru/api/posts/add/title?title=test&text=test OK


4. Редактировать пост по id
метод POST
1 - id

http://api-auth/api/posts/update/1/text?text=test OK
http://blog.garrykhr.ru/api/posts/update/1/text?text=test OK


5. Удалить пост по id
метод POST
1 - id

http://api-auth/api/posts/delete/1 OK
http://blog.garrykhr.ru/api/posts/delete/1 OK


//////////////////////////////////////////////////////////////////////////////////////////////////////////////


КОММЕНТАРИИ

1. Добавить комментарий
метод POST
2 - id поста

http://api-auth/api/comment/add/2/title?title=test&text=test OK
http://blog.garrykhr.ru/api/comment/add/2/title?title=test&text=test OK


2. Удалить комментарий
метод POST
2 - id поста
1 - id комментария

http://api-auth/api/comment/delete/2/1 OK
http://blog.garrykhr.ru/api/comment/delete/2/1 OK


//////////////////////////////////////////////////////////////////////////////////////////////////////////////


ПРОСМОТРЫ

1. Увеличить количество просмотров
метод POST
2 - id поста

http://api-auth/api/views/2 OK
http://blog.garrykhr.ru/api/views/2 OK


//////////////////////////////////////////////////////////////////////////////////////////////////////////////


ПОЛЬЗОВАТЕЛИ

1. Создать пользователя
метод POST

http://api-auth/api/auth/create/login?login=Ivan&password=999 OK
http://blog.garrykhr.ru/api/auth/create/login?login=Ivan&password=999 OK


2. Вход пользователя
метод POST

http://api-auth/api/auth/auth/login?login=admin&password=admin OK
http://blog.garrykhr.ru/api/auth/auth/login?login=admin&password=admin OK


3. Валидация токена
метод POST

OK
http://api-auth/api/auth/validate/jwt?jwt=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hbnktc2l0ZS5vcmciLCJhdWQiOiJodHRwOlwvXC9hbnktc2l0ZS5jb20iLCJpYXQiOjEzNTY5OTk1MjQsIm5iZiI6MTM1NzAwMDAwMCwiZGF0YSI6eyJsb2dpbiI6ImFkbWluIiwicGFzc3dvcmQiOiJhZG1pbiJ9fQ.zdKhCvtutlHYZcy8ZJKGyCGSp75PBzqEr5iEDAWwJZQ
OK
http://blog.garrykhr.ru/api/auth/validate/jwt?jwt=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hbnktc2l0ZS5vcmciLCJhdWQiOiJodHRwOlwvXC9hbnktc2l0ZS5jb20iLCJpYXQiOjEzNTY5OTk1MjQsIm5iZiI6MTM1NzAwMDAwMCwiZGF0YSI6eyJsb2dpbiI6ImFkbWluIiwicGFzc3dvcmQiOiJhZG1pbiJ9fQ.zdKhCvtutlHYZcy8ZJKGyCGSp75PBzqEr5iEDAWwJZQ


4. Обновление пользователя
метод POST

OK
http://api-auth/api/auth/update/jwt?jwt=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hbnktc2l0ZS5vcmciLCJhdWQiOiJodHRwOlwvXC9hbnktc2l0ZS5jb20iLCJpYXQiOjEzNTY5OTk1MjQsIm5iZiI6MTM1NzAwMDAwMCwiZGF0YSI6eyJsb2dpbiI6ImFkbWluIiwicGFzc3dvcmQiOiJhZG1pbiJ9fQ.zdKhCvtutlHYZcy8ZJKGyCGSp75PBzqEr5iEDAWwJZQ&login=admin2&password=admin2
на деплое не используется
http://blog.garrykhr.ru/api/auth/update






























