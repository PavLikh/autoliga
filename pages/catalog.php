<?php

//$arCatalog = ['body', 'mark', 'model', 'engine', 'volume', 'power', 'transmission', 'drive', 'color', 'year', 'price', 'discount', 'store'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Autoliga</title>
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/catalog.css">
</head>
<body>
	<div class="container">
		<header class="header">
			<nav class="nav">
				<div class="top_menu">
					<div class="logo">
						<span>Autoliga</span>
					</div>
					<div class="user_type">Администратор</div>
					<div class="register_block">
						<a href="" class="auth">Войти</a>	
						<a href="" class="register">Зарегистрироваться</a>
						<div class="user_name">User_name</div>
						<a href="" class="exit">Выйти</a>	
					</div>
				</div>
				<div class="main_menu">
					<ul>
						<li class="submenu">
							<a href="#">Легковые</a>
							<div class="submenu_border"></div>
							<ul>
								<li><a href="#">Седаны</a></li>
								<li><a href="#">Хетчбеки</a></li>
								<li><a href="#">Универсалы</a></li>
								<li><a href="#">Купе</a></li>
								<li><a href="#">Родстеры</a></li>
							</ul>
						</li>
						<li class="submenu">
							<a href="#">Внедорожники</a>
							<div class="submenu_border"></div>
							<ul>
								<li><a href="">Рамные</a></li>
								<li><a href="">Пикапы</a></li>
							</ul>
						</li>
						<li><a href="#">Раритетные</a></li>
						<li><a href="#">Распродажа</a></li>
						<li><a href="#">Новинки</a></li>
					</ul>
				</div>
				
			</nav>
		</header>

<?php


?>
		
		<section class="content">
					<nav class="nav_chain">
						<a href="/">Главная</a>
						<span class="nav_arrow inline-block"></span>
						<span>Легковые</span>
					</nav>
					<h1 class="">Заголовок каталога</h1>
					<div class="filter">
						<div class="engine-type">
						<h3>Двигатель:</h3>
							<div class="">
								<input id="checkbox1" class="filter-type" type="checkbox">
								<label class="filter-type-label" for="checkbox1">Бензин</label>
							</div>
							<div class="">
								<input id="checkbox2" class="" type="checkbox">
								<label class="" for="checkbox2">Дизель</label>
								</div>
						</div>
						<div class="transmission">
							<h3>Коробка:</h3>
							<div class="">
								<input id="checkbox1" class="" type="checkbox">
								<label class="" for="checkbox1">АКПП</label>
							</div>
							<div class="b-trans-type__wrapper">
								<input id="checkbox2" class="filter-type" type="checkbox">
								<label class="filter-type-label" for="checkbox2">МКПП</label>
							</div>
							<h3>Привод:</h3>
							<div class="">
								<input id="checkbox1" class="" type="checkbox">
								<label class="" for="checkbox1">Передний</label>
							</div>
							<div class="b-trans-type__wrapper">
								<input id="checkbox2" class="filter-type" type="checkbox">
								<label class="filter-type-label" for="checkbox2">Задний</label>
							</div>
							<div class="b-trans-type__wrapper">
								<input id="checkbox2" class="filter-type" type="checkbox">
								<label class="filter-type-label" for="checkbox2">Полный</label>
							</div>
						</div>
						<div class="filter_price">
							<h3>Цена:</h3>
							<div>
								<input type="text" id="price-start" placeholder="от 0 руб." class=""/>
								<input type="text" id="price-end" placeholder="до 10 000 000 руб." class=""/>
							</div>
							<div id="slider-range"></div>
						</div>
						<div class="b-color">
							<h3>Цвет:</h3>
							<div class="b-color__wrapper">
								<input id="color1" class="filter-type" type="checkbox">
								<label class="filter-type-label" for="color1">Красный</label>
							</div>
							<div class="b-color__wrapper">
								<input id="color2" class="filter-type" type="checkbox">
								<label class="filter-type-label" for="color2">Зелёный</label>
							</div>
							<div class="b-color__wrapper">
								<input id="color3" class="filter-type" type="checkbox">
								<label class="filter-type-label" for="color3">Зелёный</label>
							</div>
							<div class="b-color__wrapper">
								<input id="color4" class="filter-type" type="checkbox">
								<label class="filter-type-label" for="color4">Зелёный</label>
							</div>
						</div>
					</div>
					<section>

						<div id="catalog">
							<?php foreach ($arCatalog as $key => $item): ?>

								<?php $photoName = $detail->picture($item); ?>
							<figure class="product_item">
								<div class="product_item_pict">
									<a href="detail.php?id=<?=$item['id'] ?>">
										<img src="images/<?=$photoName?>.jpg" alt="<?=$item['mark']. ' ' .$item['model']?>" title="BMW X3 2.0d"/>
									</a>
								</div>
								<figcaption>
									<h3><a href="detail.php?id=<?=$item['id'] ?>"><?=$item['mark'] . ' ' . $item['model'] ?></a></h3>
									<span class="product_item_price dark_grey old_price"><?=$item['price']?></span>
									<p class="product_item_price dark_grey">2 230 000 руб.</p>
									<a class="buy_button inverse inline-block pie" href="#buy_popup" rel="modal:open">В корзину</a>
								</figcaption>
							</figure>
							<?php endforeach ?>





							<figure class="product_item">
								<div class="product_item_pict">
									<a href="#">
										<img src="images/no-image.jpg" alt="BMW X3 2.0d" title="**BMW X3 2.0d**"/>
									</a>
								</div>
								<figcaption>
									<h3><a href="#">**BMW X3 2.0d**</a></h3>
									<span class="product_item_price dark_grey old_price">**3 230 000 руб.**</span>
									<p class="product_item_price dark_grey">2 230 000 руб.</p>
									<a class="buy_button inverse inline-block pie" href="#buy_popup" rel="modal:open">В корзину</a>
								</figcaption>
							</figure>

						</div>
						<div class="clear"></div>
						<div class="page_nav">
							<nav>
								<a href="#" class="prev"></a>
								<span class="current">1</span>
								<a href="#">2</a>
								<a href="#">3</a>
								<a href="#">4</a>
								<a href="#">5</a>
								<span>...</span>
								<a href="#">87</a>
								<a href="#" class="next"></a>
							</nav>
						</div>
					</section>
			</section>

		<footer class="footer">
			<section class="footer_main">
				<section class="info_block">
					<h2>Информация</h2>
					<nav class="menu_footer">
						<ul>
							<li><a href="#">О компании</a></li>
							<li><a href="#" class="selected">Контактная информация</a></li>
							<li><a href="#">Условия продаж</a></li>
							<li><a href="#">Финансовый отдел</a></li>
							<li><a href="#">Для клиентов</a></li>
						</ul>
					</nav>
				</section>
				<section class="footer_logo">
					<h1>Autoliga</h1>
				</section>
				<section class="footer_link">

				</section>
			</section>
			<div class="footer_inner">
				<a href="" target="_blank" class="qsoft grey inline-block">Сделано в</a>
				<div class="copy">&copy; 2021 Автолига. Продажа автомобилей.</div>
			</div>
		</footer>
	</div>
</body>
</html>