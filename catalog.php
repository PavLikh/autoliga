<?php


include $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';
// массив товаров выводимых в каталоге
$arCatalog = $catalog->all_catalog();
// массив ключей по которым фильтруются товары
$arFilterClues = [];

$arCatalog = $catalog->all_catalog();



if ($_GET['purpose']) {
	$purposeId = $_GET['purpose'];
	$currentPage = 'purpose';
	$arCatalog = $catalog->catalogByPurpose($purposeId);
	$arNavChain = $menu->getNavChain($currentPage, $purposeId);
	$arFilter = $filter->listMarkModelBase($arCatalog);
}


if ($_GET['feature']){
	$featureId = $_GET['feature'];
	$currentPage = 'feature';
	$arCatalog = $catalog->catalogByFeature($featureId);
	$arNavChain = $menu->getNavChain($currentPage, $featureId);
	$arFilter = $filter->listMarkModelBase($arCatalog);
}



if ($_GET['mark']) {
	$arMarkId = $_GET['mark'];
	$arCatalog = $catalog->catalogByProducer($arMarkId, $purposeId, $featureId);
	$arFilter = $filter->filterByProducer($arFilter, $arCatalog);

} else {
	
}

$arFilteredCatalog = $arCatalog;

if ($_GET['model']) {
	$arModelId = $_GET['model'];
	print_r($arModelId);
	$arFilteredCatalog = $filter->catalogByModel($arModelId, $arCatalog);
}

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
									<img src="images/<?=$detail->picture($item)?>.jpg" alt="<?=$item['mark']. ' ' .$item['model']?>" title="<?=$item['mark']. ' ' .$item['model']?>"/>
								</div>
								</a>
								<figcaption>
									<h3><a href="detail.php?vehicle=<?=$item['id'] ?>"><?=$item['mark'] . ' ' . $item['model'] ?></a></h3>
									<span class="product_item_price old_price"><?=($item['discount_id'] == 2) ? number_format($item['price'], 0, '.', ' ') : ''?></span>
									<p class="product_item_price"><?=number_format(($item['discount_id'] == 2) ? $item['price'] * 0.7 : $item['price'], 0, '.', ' ') ?></p>
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

						</div>

						<div class="clear"></div>

					</section>

		</section>



<?php

include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php';

?>