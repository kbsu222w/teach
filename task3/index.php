<?php
header('Content-Type: text/html; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  if (!empty($_GET['save'])) {
    print('Результаты сохранены.<br>');
  }
  include('form.php');
  exit();
}

$errors = FALSE;

if (empty($_POST['fio']) || !preg_match("/^[a-zA-Zа-яА-ЯёЁ\s]{1,150}$/u", $_POST['fio'])) {
  print('Некорректное ФИО<br>');
  $errors = TRUE;
}

if (empty($_POST['phone'])) {
  print('Введите телефон<br>');
  $errors = TRUE;
}

if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  print('Некорректный email<br>');
  $errors = TRUE;
}

if (empty($_POST['birthdate'])) {
  print('Введите дату рождения<br>');
  $errors = TRUE;
}

if (empty($_POST['gender']) || !in_array($_POST['gender'], ['male','female'])) {
  print('Выберите пол<br>');
  $errors = TRUE;
}

$allowed = ['Pascal','C','C++','JavaScript','PHP','Python','Java','Haskel','Clojure','Prolog','Scala','Go'];

if (empty($_POST['languages'])) {
  print('Выберите язык<br>');
  $errors = TRUE;
} else {
  foreach ($_POST['languages'] as $lang) {
    if (!in_array($lang, $allowed)) {
      print('Ошибка языков<br>');
      $errors = TRUE;
      break;
    }
  }
}

if (empty($_POST['contract'])) {
  print('Нужно согласие<br>');
  $errors = TRUE;
}

if ($errors) {
  exit();
}

$user = 'formuser';
$pass = '12345';
$db = new PDO("mysql:host=localhost;dbname=form_db", $user, $pass,
  [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

try {
  $stmt = $db->prepare("INSERT INTO application 
    (fio, phone, email, birthdate, gender, bio, contract)
    VALUES (?, ?, ?, ?, ?, ?, ?)");

  $stmt->execute([
    $_POST['fio'],
    $_POST['phone'],
    $_POST['email'],
    $_POST['birthdate'],
    $_POST['gender'],
    $_POST['bio'],
    isset($_POST['contract']) ? 1 : 0
  ]);

  $user_id = $db->lastInsertId();

  $stmtLang = $db->prepare("SELECT id FROM languages WHERE name=?");
  $stmtInsert = $db->prepare("INSERT INTO user_languages (user_id, language_id) VALUES (?, ?)");

  foreach ($_POST['languages'] as $lang) {
    $stmtLang->execute([$lang]);
    $lang_id = $stmtLang->fetchColumn();
    $stmtInsert->execute([$user_id, $lang_id]);
  }

}
catch(PDOException $e){
  print('Ошибка: ' . $e->getMessage());
  exit();
}

header('Location: ?save=1');