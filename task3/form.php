<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<title>Анкета</title>

<style>
body {
  margin: 0;
  padding: 0;
}

.container {
  max-width: 600px;
  margin: 40px auto;
  padding: 25px;
  border-radius: 12px;
  box-shadow: 0 8px 20px rgba(0,0,0,0.2);
}

h1 {
  text-align: center;
}

label {
  display: block;
  margin-top: 15px;
  font-weight: bold;
}

input, select, textarea {
  width: 100%;
  padding: 8px;
  margin-top: 5px;
  border-radius: 6px;
  border: 1px solid #ccc;
  font-size: 14px;
}

textarea {
  resize: vertical;
}
.checkbox{
  display: inline-flex;
  align-items: center;
  cursor: pointer;
  font-size: 16px;
  font-weight: bold;
}
.gender {
  display: flex;
  gap: 20px;
  margin-top: 5px;
}


button {
  margin-top: 20px;
  width: 100%;
  padding: 12px;
  background: green;
  color: white;
  border: none;
  border-radius: 8px;
  font-size: 16px;
  cursor: pointer;
}

button:hover {
  background: #45a049;
}
</style>

</head>
<body>

<div class="container">
  <h1>Анкета</h1>

  <form action="" method="POST">

    <label>ФИО</label>
    <input type="text" name="fio" required>

    <label>Телефон</label>
    <input type="tel" name="phone" required>

    <label>Email</label>
    <input type="email" name="email" required>

    <label>Дата рождения</label>
    <input type="date" name="birthdate" required>

    <label>Пол</label>
    <div class="gender">
      <label><input type="radio" name="gender" value="male" required> Мужской</label>
      <label><input type="radio" name="gender" value="female"> Женский</label>
    </div>

    <label>Любимые языки программирования</label>
    <select name="languages[]" multiple size="6">
      <option>Pascal</option>
      <option>C</option>
      <option>C++</option>
      <option>JavaScript</option>
      <option>PHP</option>
      <option>Python</option>
      <option>Java</option>
      <option>Haskel</option>
      <option>Clojure</option>
      <option>Prolog</option>
      <option>Scala</option>
      <option>Go</option>
    </select>

    <label>Биография</label>
    <textarea name="bio" rows="4"></textarea>

    <div class="checkbox">
        С контрактом ознакомлен(а)
        <input type="checkbox" name="contract" required>
    </div>

    <button type="submit">Сохранить</button>

  </form>
</div>

</body>
</html>