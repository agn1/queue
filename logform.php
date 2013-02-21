<html>
<head>
<meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" media="all" href="css/style.css" />
<title>Home</title>
</head>
<body>
<form action="authorization.php" method="post">
  
	<div class="input-control text span3 as-block">
		<label>Ваш логин:<br></label>
		<input name="login" type="text" placeholder="Enter login" name="login"  size="15" maxlength="15">
    </div>
<!--**** В текстовое поле (name="login" type="text") пользователь вводит свой логин ***** -->  
  
    <div class="input-control text span3 as-block">
		<label>Ваш пароль:<br></label>
		<input name="password" type="password" placeholder="Enter password" size="15" maxlength="15">
     
	</div>
<!--**** В поле для паролей (name="password" type="password") пользователь вводит свой пароль ***** -->  
	<p>
		<input type="submit" name="submit" value="Войти">

<!--**** ссылка на регистрацию, ведь как-то же должны гости туда попадать ***** --> 
		<a class="button" href="reg.php">Зарегистрироваться</a> 
	</p>
</form>
</body>
</html>