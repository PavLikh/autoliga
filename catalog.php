<?php


include $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';
// массив товаров выводимых в каталоге
$arCatalog = $catalog->all_catalog();
// массив ключей по которым фильтруются товары
$arFilterClues = [];
 print_r($_GET);
// print_r($_POST);

$arCatalog = $catalog->all_catalog();
// $arNavChain =$menu->getNavChain($arMainMenu);


if ($_GET['purpose']) {
	$purposeId = $_GET['purpose'];
	$currentPage = 'purpose';
	$arCatalog = $catalog->catalogByPurpose($purposeId);
	//$arNavChain = $menu->getNavChain($arMainMenu, $purposeId);
	$arNavChain = $menu->getNavChain($currentPage, $purposeId);
	// $arFilter = $filter->getListMark($arCatalog);
	$arFilter = $filter->listMarkModelBase($arCatalog);
	//$arFilterClues[] = 'purpose';
}


if ($_GET['feature']){
	$featureId = $_GET['feature'];
	$currentPage = 'feature';
	$arCatalog = $catalog->catalogByFeature($featureId);
	//$arNavChain = $menu->getNavChain($arMainMenu, null, $featureId);
	$arNavChain = $menu->getNavChain($currentPage, $featureId);
	//$arFilter = $filter->getListMark($arCatalog);
	$arFilter = $filter->listMarkModelBase($arCatalog);

	//$arFilterClues[] = 'feature';
}



if ($_GET['mark']) {
	$arMarkId = $_GET['mark'];

	//$arFilteredCatalog = $filter->catalogByMark($arMarkId, $arCatalog);

	$arCatalog = $catalog->catalogByProducer($arMarkId, $purposeId, $featureId);
	$arFilter = $filter->filterByProducer($arFilter, $arCatalog);
	//$arFilterClues[] = 'mark';
} else {
	//$arFilteredCatalog = $arCatalog;	
}

$arFilteredCatalog = $arCatalog;

if ($_GET['model']) {
	$arModelId = $_GET['model'];
	print_r($arModelId);
	//print_r($arCatalog);
	//$arFilteredCatalog = $filter->catalogByModel($arModelId, $arFilteredCatalog);
	$arFilteredCatalog = $filter->catalogByModel($arModelId, $arCatalog);
}

//$arNavChain = $menu->getNavChain();
//$arFilter = $filter->getListMark($arCatalog);

//$arFilter = ['mark' => ['Mersedes_benz', 3 => 'Hyundai'], 'model' => [16 => 'Elantra', 'C-class']];


//$arCatalog = ['body', 'mark', 'model', 'engine', 'volume', 'power', 'transmission', 'drive', 'color', 'year', 'price', 'discount', 'store'];
echo '<pre>';
// echo '$arFilterClues: ';
// print_r($arFilterClues);
echo '$arCatalog: ';
echo '$arFilter: ';
//print_r($arFilter);
//echo '$arFilteredCatalog: ';
//print_r($arFilteredCatalog);
//print_r($arNavChain);
//print_r($arMainMenu);

echo '</pre>';
?>

		
		<section class="content">
					<nav class="nav_chain">
						<a href="/">Главная</a>
						<?php foreach ($arNavChain as $itemChain):?>
							<span class="nav_arrow inline-block">></span>
							<span><?=$itemChain?></span>
						<?php endforeach ?>
					</nav>
					<h1 class="">Заголовок каталога</h1>
					<div class="filter">
						<form action="" method="get">

							<fieldset>
								<legend> <h3> Марка</h3></legend>
								<div class="">
									<select name="mark[]" size="4" multiple="multiple">

										<?php foreach ($arFilter['mark'] as $key => $value): ?>
											<option value="<?=$key?>"><?=$value?></option>	
										<?php endforeach ?>

									</select>

								</div>
							</fieldset>
							<fieldset>
								<legend> <h3> Модель</h3></legend>
								<div class="">
									<select name="model[]" size="4" multiple="multiple">

										<?php foreach ($arFilter['model'] as $key => $value): ?>
											<option value="<?=$key?>"><?=$value?></option>	
										<?php endforeach ?>
																					

									</select>

								</div>
							</fieldset>

							<input type="hidden" name="purpose" value="<?=$purposeId?>">
							<input type="hidden" name="feature" value="<?=$featureId?>">
							<input type="submit" value="Выбрать">
						</form>




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
							<?php if ($arFilteredCatalog): ?>
							<?php foreach ($arFilteredCatalog as $key => $item): ?>

							<figure class="product_item">
								<a href="detail.php?vehicle=<?=$item['id'] ?>">
								<?php if ($item['discount_id'] == 2):?>
									<div class="product_item_label special_price"></div>
								<?php elseif ($item['discount_id'] == 3): ?>
									<div class="product_item_label gift"></div>
								<?php endif ?>
								<div class="product_item_pict">
									<!-- <a href="detail.php?vehicle=<?=$item['id'] ?>"> -->
										<!-- <img src="images/<?=$photoName?>.jpg" alt="<?=$item['mark']. ' ' .$item['model']?>" title="<?=$item['mark']. ' ' .$item['model']?>"/> -->
										<img src="images/<?=$detail->picture($item)?>.jpg" alt="<?=$item['mark']. ' ' .$item['model']?>" title="<?=$item['mark']. ' ' .$item['model']?>"/>
									<!-- </a> -->
								</div>
								</a>
								<figcaption>
									<h3><a href="detail.php?vehicle=<?=$item['id'] ?>"><?=$item['mark'] . ' ' . $item['model'] ?></a></h3>
									<span class="product_item_price old_price"><?=($item['discount_id'] == 2) ? number_format($item['price'], 0, '.', ' ') : ''?></span>
									<p class="product_item_price"><?=number_format(($item['discount_id'] == 2) ? $item['price'] * 0.7 : $item['price'], 0, '.', ' ') ?></p>
									<!-- <a class="buy_button inverse inline-block pie" href="#buy_popup" rel="modal:open">В корзину</a> -->
								</figcaption>
								<?php if ($_SESSION['user'] == 'content'): ?>

									<div class="edit">							
										<button class="button <?=$item['editable'] == 1 ? 'edit' : 'disable'?>" onClick="javascript:window.location.href='';">Изменить</button>
										<button class="button <?=$item['editable'] == 1 ? 'del' : 'disable'?>" onClick="javascript:window.location.href='';">Удалить</button>
									</div>
								

								<?php endif ?>
							</figure>
							<?php endforeach ?>


							<?php else: ?>
								<span>Не найдено </span>
						<?php endif ?>


							<figure class="product_item">
								<div class="product_item_pict">
									<a href="#">
										<img src="images/one-no-image.jpg" alt="BMW X3 2.0d" title="**BMW X3 2.0d**"/>
									</a>
								</div>
								<figcaption>
									<h3><a href="#">**BMW X3 2.0d**</a></h3>
									<span class="product_item_price dark_grey old_price">**3 230 000 руб.**</span>
									<p class="product_item_price dark_grey">2 230 000 руб.</p>
									<?php if ($_SESSION['user'] == 'content'): ?>
										<div class="edit">						
										<button class="button disable" onClick="javascript:window.location.href='';">Изменить</button>
										<button class="button disable" onClick="javascript:window.location.href='';">Удалить</button>
										</div>
									<?php endif ?>
								</figcaption>
							</figure>


							<figure class="product_item">
								<a href="#">
								<div class="product_item_label gift"></div>
								<div class="product_item_label special_price"></div>
								<div class="product_item_pict">
									<!-- <a href="#"> -->
									<img src="images/014_audi_a4_yellow.jpg" alt="BMW X3 2.0d" title="BMW X3 2.0d"/>
									<!-- </a> -->
								</div>
								</a>
								<figcaption>
									<h3><a href="#">BMW X3 2.0d</a></h3>
                            		<span class="product_item_price dark_grey old_price">3 230 000 руб.</span>
									<p class="product_item_price dark_grey">2 230 000 руб.</p>
									<a class="buy_button inverse inline-block pie" href="#">В корзину</a>
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



<?php

include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php';

?>