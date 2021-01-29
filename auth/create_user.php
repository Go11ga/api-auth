<?php
  /**
   * * Заголовки
   */
  header("Access-Control-Allow-Orgin: *");
  header("Access-Control-Allow-Methods: *");
  header("Content-Type: application/json");
  
  /**
   * * "Подключение к БД"
   */
  include_once 'db/users.php';
  $db_users = new Users();

  $login=$_REQUEST['login'];
  $password=$_REQUEST['password'];
  
  // Вариант с ЧПУ
  // $data = json_decode(file_get_contents("php://input"));
  // $db_users->login = $data->login;
  // $db_users->password = $data->password;

  $db_users->login = $login;
  $db_users->password = $password;

  /**
   * * Создание пользователя
   */
  if (
    !empty($login) &&
    !empty($password) &&
    $db_users->create()
  ) {
    http_response_code(200);
    echo json_encode(array("message" => "Пользователь был создан."));

  } else {
    http_response_code(400);
    echo json_encode(array("message" => "Невозможно создать пользователя."));
  }
?>
