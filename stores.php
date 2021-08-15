<?php

//require_once 'app/provider.php';

include $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';

$arStores = $store->arStores();
$arNavChain = $menu->getNavChain($_SERVER['REQUEST_URI']);

echo '<pre>';
//print_r($_SERVER);
//print_r($_SERVER['REQUEST_URI']);
//print_r($arMainMenu);
//print_r($arNavChain);
echo '</pre>';

?>

<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
<script type="text/javascript">
		var myMap;
	
  		function initMap ()
  		{

  			myMap = new ymaps.Map("yandexmap", {
    			center: [57.799, 37.114],
    			zoom: 5.2,
    		});
  			//var pointer = [];
  			<?php
  				foreach ($arStores as $key => $item) { ?>
  					//pointer = [<?=$item['coordinates'] ?>];
  					myGeoObject = new ymaps.Placemark([<?=$item['coordinates'] ?>],
  						{
    						balloonContentBody: '<img src="http://img-fotki.yandex.ru/get/6114/82599242.2d6/0_88b97_ec425cf5_M" />',
    						balloonContentFooter: '<a href="#">Ссылка</a>',
    				
    						hintContent: "<?=$item['address_ru']?>",
   							//iconContent: "Азербайджан"
   						}, 
   						{
    						preset: "islands#greenStretchyIcon",
    						// Отключаем кнопку закрытия балуна.
    						//balloonCloseButton: false,
    			 			// Балун будем открывать и закрывать кликом по иконке метки.
    						hideIconOnBalloonOpen: false
    			});

  				myMap.geoObjects.add(myGeoObject);
  				myMap.controls.remove('searchControl'); //удалить поле поиска

		<?php } ?>

		var place;
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
	<section class="stores">
		<section class="stores_list">
			<?php foreach ($arStores as $item): ?>
				<a href="store.php?storeId=<?=$item['id']?>">
					<figure class="store_item">

						<figcaption>
							<h3><?=$item['name_ru']?></h3>
							<p>Регион: <?=$item['region']?></p>
                			<p class=""><?=$item['address']?></p>

						</figcaption>
					</figure>
				</a>
			<?php endforeach ?>

		</section>
 		<section class="map">
			<div id="yandexmap" style="width: 100%; height: 500px"></div> 	
 		</section>
	</section>
	
</section>

<?php

include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php';

?>