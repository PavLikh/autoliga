<?php
session_start();

print_r($_SESSION);

require_once 'app/QueryBuilder.php';
require_once 'app/servises.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/provider.php';
$arMainMenu = $menu->main_menu();
//$arNavChain =$menu->getNavChain($arMainMenu);


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Autoliga</title>
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/catalog.css">
	<link rel="stylesheet" href="css/detail.css">
  	<link rel="stylesheet" href="css/stores.css">
  	<script type="text/javascript" src="/js/jquery-360.min.js"></script>

</head>
<body>
	<div class="container">
		<header class="header">
			<nav class="nav">
				<div class="top_menu">
					<div class="logo">
						<a href="/"><span>Autoliga</span></a>
					</div>

					<a class="user_type <?=!$_SESSION['user'] ? 'active' : '' ?>" href="auth.php?source=<?=namePage($_SERVER['PHP_SELF'])?>">Посетитель</a>
					<a class="user_type <?=$_SESSION['user'] == 'content' ? 'active' : '' ?>" href="auth.php?user=content&source=<?=namePage($_SERVER['PHP_SELF'])?>">Контент менеджер</a>

					<div class="register_block">
						<a href="" class="auth">Войти</a>	
						<a href="" class="register">Зарегистрироваться</a>
						<div class="user_name">User_name</div>
						<a href="" class="exit">Выйти</a>	
					</div>
				</div>

<?php


?>



				<div class="main_menu">
					<ul>
						<?php foreach ($arMainMenu as $key => $li): ?>
							<?php if (is_numeric($key)) :?>
							<?php	$purpose_id = $key; ?>
								<?php if ($key > 9): ?>
									<li class="submenu">

									<a href="<?=$li[1]?>"><?=$li[0] ?></a>

								<?php endif ?>
							<?php endif ?>
							<?php if (!is_numeric($key)) : ?>
							<li class="submenu">

								<a href="catalog.php?purpose=<?=$purpose_id ?>"><?=$key; ?></a>
								<div class="submenu_border"></div>
							<?php // endif ?>
								<ul>
									<?php foreach ($li as $subKey => $subLi): ?>
										<li><a href="catalog.php?feature=<?=$subKey ?>"><?=$subLi?></a></li>
									<?php endforeach ?>

								</ul>
							</li>
							<?php endif ?>
						<?php endforeach ?>
						<li class="submenu">
							<a href="#">Внедорожники</a>
							<div class="submenu_border"></div>
							<ul>
								<li><a href="">Рамные</a></li>
								<li><a href="">Пикапы</a></li>
							</ul>
						</li>
						<li><a href="catalog.php">КАТАЛОГ</a></li>
						<li><a href="promotion.php">Покупателям</a></li>
					</ul>
				</div>
				
			</nav>
		</header>