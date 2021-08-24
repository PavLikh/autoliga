<?php

include $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';

$vehicleId = 0;

if($_POST['vehicle']) {
	$_GET['vehicle'] = $_POST['vehicle'];
}

if ($_GET['vehicle']) {
	$vehicleId = $_GET['vehicle'];
	$currentPage = 'vehicle';
	$arDetail = $detail->detailData($vehicleId);
	$arNavChain = $menu->getNavChain($currentPage, $vehicleId);

	$photoName = $detail->picture($arDetail);

}

?>
<script>
	var vehicleId = '<?=$vehicleId?>';
</script>		
		
			<nav class="nav_chain">
				<a href="/">Главная</a>
				<?php foreach ($arNavChain as $itemChain):?>
					<span class="nav_arrow inline-block">></span>
					<span><?=$itemChain?></span>
				<?php endforeach ?>
			</nav>
			<section class="content">
			<h1 class=""><?=$arDetail['mark'] . ' ' . $arDetail['model']?></h1>
			<figure class="product_detail">
			<figcaption>
				<div class="product-photo">
					<div class="main_photo">
						<img class="" src="images/<?=$photoName?>.jpg">
					</div>

				</div>
				<div class="discount">

					<?php if ($arDetail['discount_id'] == 2): ?>
						<div class="special_price">На данный автомобиль действует специальная цена</div>
					<?php elseif ($arDetail['discount_id'] == 3): ?>
						<div class="gift">Купи автомобиль и получи подарок</div>
					<?php endif ?>

				</div>
				<div class="price_block">
					<p class="product_item_price"><b class="orange"><?=number_format(($arDetail['discount_id'] == 2) ? $arDetail['price'] * 0.7 : $arDetail['price'], 0, '.', ' ') ?></b> руб.
					<span class="product_item_price old_price"><?=($arDetail['discount_id'] == 2) ? number_format($arDetail['price'], 0, '.', ' ') : ''?></span></p>
				</div>
				<div class="slide_box">
					<h3 class=" slide_panel show">Параметры
					</h3>
					<div class="slide_block" style="display:block">
						<table class="features">
							<tr>
								<td><div><span>Двигатель:</span></div></td>
								<td><?=$arDetail['engine']?>, <?=$arDetail['volume']?>, <?=$arDetail['power']?> л.с.</td>
							</tr>
							<tr>
								<td><div><span>КПП:</span></div></td>
								<td><?=$arDetail['transmission']?></td>
							</tr>
							<tr>
								<td><div><span>Привод:</span></div></td>
								<td><?=$arDetail['drive']?></td>
							</tr>
							<tr>
								<td><div><span>Год выпуска:</span></div></td>
							<td><?=$arDetail['year']?></td>
							</tr>
							<tr>
								<td><div><span>Цвет:</span></div></td>
								<td><?=$arDetail['color']?></td>
							</tr>
							<tr>
								<td><div><span>Кузов:</span></div></td>
								<td><?=$arDetail['body']?></td>
							</tr>
								<td><div><span>Салон:</span></div></td>
								<td><a href='store.php?storeId=<?=$arDetail['store_id'] ?>'><b><?=$arDetail['store'] ?></b></a></td>
							</tr>

						</table>
					</div>
				</div>

								
			</figcaption>
			</figure>

		</section>

<script>
	var test = '<?=$vehicleId?>';
</script>

<script type="text/javascript" src="/js/main.js"></script>



<?php

include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php';

?>