1. Создание пользователя

http://api-auth/api/auth/create OK
http://blog.garrykhr.ru/api/auth/create OK
метод POST
Body -> raw 

Тест для 200:
{
  "login" : "Ivan",
  "password" : "999"
}

Тест для 400 (Bad request):
Отправить тот же самый запрос еще раз

2. Вход пользователя

http://api-auth/api/auth/auth OK
http://blog.garrykhr.ru/api/auth/auth OK
метод POST
Body -> raw

Тест для 200:
{
  "login" : "admin",
  "password" : "admin"
}
Response: "jwt": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hbnktc2l0ZS5vcmciLCJhdWQiOiJodHRwOlwvXC9hbnktc2l0ZS5jb20iLCJpYXQiOjEzNTY5OTk1MjQsIm5iZiI6MTM1NzAwMDAwMCwiZGF0YSI6eyJuYW1lIjoiYWRtaW4iLCJwYXNzd29yZCI6ImFkbWluIn19.noSABdIl-2YGDj-EkSucXT9ppOy3wbgMrDdBmeMmPlk"

Тест для 401 (Unauthorized):
{
  "login" : "admin",
  "password" : "admin2"
}

3. Валидация токена

http://api-auth/api/auth/validate OK
http://blog.garrykhr.ru/api/auth/validate OK
метод POST
Body -> raw

Тест для 200 (Token admin):
{
  "jwt": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hbnktc2l0ZS5vcmciLCJhdWQiOiJodHRwOlwvXC9hbnktc2l0ZS5jb20iLCJpYXQiOjEzNTY5OTk1MjQsIm5iZiI6MTM1NzAwMDAwMCwiZGF0YSI6eyJsb2dpbiI6ImFkbWluIiwicGFzc3dvcmQiOiJhZG1pbiJ9fQ.zdKhCvtutlHYZcy8ZJKGyCGSp75PBzqEr5iEDAWwJZQ"
}
Response:
{
  "message": "Доступ разрешен.",
  "data": {
    "login": "admin",
    "password": "admin"
  }
}

Тест для 401 (Unauthorized):
{
  "jwt": "EDITEDAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hbnktc2l0ZS5vcmciLCJhdWQiOiJodHRwOlwvXC9hbnktc2l0ZS5jb20iLCJpYXQiOjEzNTY5OTk1MjQsIm5iZiI6MTM1NzAwMDAwMCwiZGF0YSI6eyJuYW1lIjoiYWRtaW4iLCJwYXNzd29yZCI6ImFkbWluIn19.noSABdIl-2YGDj-EkSucXT9ppOy3wbgMrDdBmeMmPlk"
}
Response:
{
  "message": "Доступ закрыт.",
  "error": "Unexpected control character found"
}

4. Обновление пользователя
http://api-auth/api/auth/update OK
http://blog.garrykhr.ru/api/auth/update OK
метод POST
Body -> raw

Тест для 200 (Token admin):
{
  "login" : "admin2",
  "password" : "admin2",
  "jwt": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hbnktc2l0ZS5vcmciLCJhdWQiOiJodHRwOlwvXC9hbnktc2l0ZS5jb20iLCJpYXQiOjEzNTY5OTk1MjQsIm5iZiI6MTM1NzAwMDAwMCwiZGF0YSI6eyJuYW1lIjoiYWRtaW4iLCJwYXNzd29yZCI6ImFkbWluIn19.noSABdIl-2YGDj-EkSucXT9ppOy3wbgMrDdBmeMmPlk"
}
Response:
{
  "message": "Пользователь был обновлён",
  "jwt": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hbnktc2l0ZS5vcmciLCJhdWQiOiJodHRwOlwvXC9hbnktc2l0ZS5jb20iLCJpYXQiOjEzNTY5OTk1MjQsIm5iZiI6MTM1NzAwMDAwMCwiZGF0YSI6eyJuYW1lIjoiYWRtaW4yIiwicGFzc3dvcmQiOiJhZG1pbjIifX0.Tlt4YIx63jimgYGfsIrn_uFPpg8jV_5GvLdwndbQ7HA"
}

Тест для 400 (Bad request):
Отправить тот же самый запрос еще раз

Тест для 401 (Unauthorized):
{
  "login" : "admin2",
  "password" : "admin2",
  "jwt": "EDITEDAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hbnktc2l0ZS5vcmciLCJhdWQiOiJodHRwOlwvXC9hbnktc2l0ZS5jb20iLCJpYXQiOjEzNTY5OTk1MjQsIm5iZiI6MTM1NzAwMDAwMCwiZGF0YSI6eyJuYW1lIjoiYWRtaW4iLCJwYXNzd29yZCI6ImFkbWluIn19.noSABdIl-2YGDj-EkSucXT9ppOy3wbgMrDdBmeMmPlk"
}

5. Получить все посты
http://api-auth/api/posts OK
http://blog.garrykhr.ru/api/posts OK
метод GET

6. Получить один пост
http://api-auth/api/posts/1 OK
http://blog.garrykhr.ru/api/posts/1 OK
метод GET

7. Добавить один пост
http://api-auth/api/posts/add OK
http://blog.garrykhr.ru/api/posts/add OK
метод POST

Тест для 200:
{
  "title" : "New title",
  "text" : "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut dolores blanditiis quaerat tempore eos voluptatum quod ratione, illum quia ab natus commodi dolor maxime iure dignissimos dolorum nostrum numquam dicta?"
}

8. Редактирование поста по id
http://api-auth/api/posts/update/1 OK
http://blog.garrykhr.ru/api/posts/update/1 OK
метод POST

Тест для 200:
{
  "text" : "test"
}

9. Удаление поста по id
http://api-auth/api/posts/delete/1 OK
http://blog.garrykhr.ru/api/posts/delete/1 OK
метод POST

10. Добавление комментария
http://api-auth/api/comment/add/2 OK
http://blog.garrykhr.ru/api/comment/add/2 OK
метод POST

Тест для 200:
{
  "title" : "test",
  "text" : "test"
}

10. Удаление комментария
http://api-auth/api/comment/delete/2/1 OK
http://blog.garrykhr.ru/api/comment/delete/2/1 OK
метод POST

2 - id поста
1 - id комментария

11. Увеличить количество просмотров
http://api-auth/api/views/2 OK
http://blog.garrykhr.ru/api/views/2 OK
метод POST

2 - id поста