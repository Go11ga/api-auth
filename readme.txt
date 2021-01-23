1. Создание пользователя

http://api-auth/api/create
метод POST
Body -> raw 

Тест для 200:
{
  "name" : "Ivan",
  "password" : "999"
}

Тест для 400 (Bad request):
Отправить тот же самый запрос еще раз

2. Вход пользователя

http://api-auth/api/auth
метод POST
Body -> raw

Тест для 200:
{
  "name" : "admin",
  "password" : "admin"
}
Response: "jwt": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hbnktc2l0ZS5vcmciLCJhdWQiOiJodHRwOlwvXC9hbnktc2l0ZS5jb20iLCJpYXQiOjEzNTY5OTk1MjQsIm5iZiI6MTM1NzAwMDAwMCwiZGF0YSI6eyJuYW1lIjoiYWRtaW4iLCJwYXNzd29yZCI6ImFkbWluIn19.noSABdIl-2YGDj-EkSucXT9ppOy3wbgMrDdBmeMmPlk"

Тест для 401 (Unauthorized):
{
  "name" : "admin",
  "password" : "admin2"
}

3. Валидация токена

http://api-auth/api/validate
метод POST
Body -> raw

Тест для 200 (Token admin):
{
  "jwt": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hbnktc2l0ZS5vcmciLCJhdWQiOiJodHRwOlwvXC9hbnktc2l0ZS5jb20iLCJpYXQiOjEzNTY5OTk1MjQsIm5iZiI6MTM1NzAwMDAwMCwiZGF0YSI6eyJuYW1lIjoiYWRtaW4iLCJwYXNzd29yZCI6ImFkbWluIn19.noSABdIl-2YGDj-EkSucXT9ppOy3wbgMrDdBmeMmPlk"
}
Response:
{
  "message": "Доступ разрешен.",
  "data": {
    "name": "admin",
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
http://api-auth/api/update
метод POST
Body -> raw

Тест для 200 (Token admin):
{
  "name" : "admin2",
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
  "name" : "admin2",
  "password" : "admin2",
  "jwt": "EDITEDAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hbnktc2l0ZS5vcmciLCJhdWQiOiJodHRwOlwvXC9hbnktc2l0ZS5jb20iLCJpYXQiOjEzNTY5OTk1MjQsIm5iZiI6MTM1NzAwMDAwMCwiZGF0YSI6eyJuYW1lIjoiYWRtaW4iLCJwYXNzd29yZCI6ImFkbWluIn19.noSABdIl-2YGDj-EkSucXT9ppOy3wbgMrDdBmeMmPlk"
}