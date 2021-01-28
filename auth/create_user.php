<?php
  /**
   * * Заголовки
   */
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
  /**
   * * "Подключение к БД"
   */
  include_once 'db/users.php';
  $db_users = new Users();
  
  /**
   * * Получаем данные
   */
  $data = json_decode(file_get_contents("php://input"));
  $db_users->login = $data->login;
  $db_users->password = $data->password;

  /**
   * * Создание пользователя
   */
  if (
    !empty($db_users->login) &&
    !empty($db_users->password) &&
    $db_users->create()
  ) {
    http_response_code(200);
    echo json_encode(array("message" => "Пользователь был создан."));

  } else {
    http_response_code(400);
    echo json_encode(array("message" => "Невозможно создать пользователя."));
  }
?>
