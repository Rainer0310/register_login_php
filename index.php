<?php require("register.class.php") ?>
<?php
	if(isset($_POST['submit'])){
		$user = new RegisterUser($_POST['login'], $_POST['password'], $_POST ['conf_pass'], $_POST['email'], $_POST['name']);
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	 <link rel="stylesheet" href="styles.css">
	<title>Register form</title>
</head>
<body>

	<form action="" method="post" enctype="multipart/form-data" autocomplete="off">
		<h2>Форма регистрации</h2>

		<label>Логин</label><br>
		<input type="text" name="login" pattern= "\S{6,}"><br>

		<!-- <label for= "text">Логин слишком мал </label><br><br> -->

		<label>Пароль</label><br>
		<input type="text" name="password" pattern="[A-Za-zА-Яа-яЁё0-9]{6,}"><br>

		<!-- <label for= "text">Пароль слишком мал </label><br><br> -->

		<label>Повторите пароль</label><br>
		<input type="text"  name="conf_pass" pattern="[A-Za-zА-Яа-яЁё0-9]{6,}"><br><br>

		<label>Электронная почта</label><br>
		<input type="email" name="email"><br><br>

		<label>Имя пользователя</label><br>
		<input type="text" name="name" pattern= "[A-Za-zА-Яа-яЁё]{2}"><br>

		<!-- <label for= "text">Имя пользователя слишком мало </label><br><br> -->


		<button type="submit" name="submit">Зарегестрироваться</button>

		<p class="error"><?php echo @$user->error ?></p>
		<p class="success"><?php echo @$user->success ?></p>
	</form>

</body>
</html>