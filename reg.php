<html>
<head>
<meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" media="all" href="css/style.css" />
<title>Регистрация</title>
</head>
<body class="modern-ui">
 
<div style="margin: 5% 0  0 15%" class="page-header">

<div class="page-header-content">
                 <a href="index.php" class="back-button big page-back"></a>
                <h2>Регистрация</h2>
				<h4>Просьба указывать реальные, различные бэтманы в отдыхе не нуждаются.</h4>
</div>

<form action="save_user.php" method="post">
<!--**** save_user.php - это адрес обработчика. То есть, после нажатия на кнопку "Зарегистрироваться", данные из полей отправятся на страничку save_user.php методом "post" ***** -->
  <div class="input-control text span3 as-block">
    <label>Ваш логин:<br></label>
    <input name="login" type="text" placeholder="Enter login" size="15" maxlength="15">
  </div>
<!--**** В текстовое поле (name="login" type="text") пользователь вводит свой логин ***** -->  
  <div class="input-control text span3 as-block">
    <label>Ваше имя:<br></label>
    <input name="name" type="text" placeholder="Enter name" size="15" maxlength="15">
  </div>
  <div class="input-control text span3 as-block">
    <label>Ваш фамилия:<br></label>
    <input name="last_name" type="text" placeholder="Enter last name" size="15" maxlength="15">
  </div>
  <div style="width: 20%" class="input-control select">
	<label>Тип аккаунта:<br></label>
        <select name="type">
			<option value=""></option>
            <option value="iso">ИСО</option>
			<option value="tp">Тех. поддержка</option>
        </select>
  </div>
  <div class="input-control text span3 as-block">
    <label>Ваш пароль:<br></label>
    <input name="password" type="password" placeholder="Enter password" size="15" maxlength="15">
  </div>

	<p>
		<input type="submit" name="submit" value="Зарегистрироваться">
	</p>
</form>
</div>
</body>
</html>
