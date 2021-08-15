<?php

//require_once 'app/provider.php';

include $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';


if ($_GET['storeId']) {
	$storeId = $_GET['storeId'];
	$arStore = $store->storeById($_GET['storeId']);
  $arNavChain = ['Наши салоны', $arStore['name_ru']];
  $arCatalog = $store->vehicleByStore($_GET['storeId']);

}

//$arStore = $store->storeById();
//$arNavChain = $menu->getNavChain($_SERVER['REQUEST_URI']);

echo '<pre>';
//	print_r($arCatalog);
echo '</pre>';

?>

<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
<script type="text/javascript">
		var myMap;
	
  		function initMap ()
  		{

  			myMap = new ymaps.Map("yandexmap", {
    			center: [<?=$arStore['coordinates']?>],
    			zoom: 12,

        });

  			myGeoObject = new ymaps.Placemark([<?=$arStore['coordinates'] ?>],
  			{
    			balloonContentBody: '<h3><?=$arStore['name_ru']?></h3>',
    			balloonContentFooter: '<?=$arStore['address']?>',
    				
    			hintContent: "<?=$arStore['address']?>",
   				iconContent: "<?=$arStore['name_ru']?>"
   			}, 
   			{
    			preset: "islands#greenStretchyIcon",
    						// Отключаем кнопку закрытия балуна.
    						//balloonCloseButton: false,
    			 			// Балун будем открывать и закрывать кликом по иконке метки.
    			hideIconOnBalloonOpen: false
    		});

  			myMap.geoObjects.add(myGeoObject);
        myMap.controls.remove('searchControl');

   	}
	ymaps.ready(initMap);
</script>

	
		
<nav class="nav_chain">
	<a href="/">Главная</a>
	<?php foreach ($arNavChain as $itemChain):?>
		<span class="nav_arrow inline-block">></span>
		<span><?=$itemChain?></span>
	<?php endforeach ?>
</nav>

<section class="content">
	<section class="store">

			<figure class="store_item">

				<figcaption>
					<h2><?=$arStore['name_ru']?></h2>
				    <p>Регион: <?=$arStore['region']?></p>
          	<p class=""><?=$arStore['address']?></p>
            <p>Телефон: +7(001)999-99-99</p>
          
					</figcaption>
			</figure>

 		<section class="map">
			<div id="yandexmap" style="width: 100%; height: 500px"></div> 	
 		</section>
	</section>
      <h2>Авто представленные в салоне</h2>
  <section class="product_line">
    <div id="catalog">
              <?php if ($arCatalog): ?>
              <?php foreach ($arCatalog as $key => $item): ?>

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
              </figure>
              <?php endforeach ?>


              <?php else: ?>
                <span>Не найдено </span>
            <?php endif ?>
    </div>

      </section>
</section>

<?php

include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php';

?>