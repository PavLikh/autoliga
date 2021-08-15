<?php

//require_once 'app/provider.php';

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

echo '<pre>';
//print_r($_GET);
//print_r($arDetail);
print_r($_POST);
echo $photoName;
echo '</pre>';

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
<!-- 					<div class="thumbnail_list">
						<div class="thumbnail_item">
							<img class="" src="images/<?=$photoId?>_mercedes_c_01.jpg">
						</div>
						<div class="thumbnail_item">
							<img class="" src="images/mercedes_c_02.jpg" alt="BMW Z4 sDrive 35i 2">
						</div>
						<div class="thumbnail_item">
							<img class="" src="images/mercedes_c_03.jpg" alt="BMW Z4 sDrive 35i 3">
						</div>
					</div> -->
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
							<tr>
								<td><div><span>Салон:</span></div></td>
								<td><button onClick="javascript:window.location.href='store.php?storeId=2';"><?=$arDetail['store'] ?></button></td>
							</tr>
							<td><div><span>Салон:</span></div></td>
								<td><a href='store.php?storeId=<?=$arDetail['store_id'] ?>';"><b><?=$arDetail['store'] ?></b></a></td>
							</tr>
							<tr>
								<!-- <td><button class="button <?=$arDetail['editable'] == 1 ? 'edit' : 'disable'?>" onClick="javascript:window.location.href='';">Изменить</button></td> -->
								<td><button class="button <?=$arDetail['editable'] == 1 ? 'edit' : 'disable'?>" id="button">Изменить JS</button></td>
								<td><button class="button <?=$arDetail['editable'] == 1 ? 'del' : 'disable'?>" onClick="javascript:window.location.href='';">Удалить</button></td>
								<td><button class="" id="button">Кнопка</button><p class="out"></p></td>


								<td><?=$vehicleId?><button class="test change_city">Send AJAX-request</button></td>

								<script>

								</script>

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