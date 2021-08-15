<?php

//require_once 'app/provider.php';

include $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';

$vehicleId = 0;
if ($_GET['vehicle']) {
	$vehicleId = $_GET['vehicle'];

	$arDetail = $detail->detailData($vehicleId);

	$photoName = $detail->picture($arDetail);

}


//print_r($_GET);
//print_r($arDetail);
echo $photoName;


?>

		
		
<nav class="nav_chain">
	<a href="/">Главная</a>
	<?php foreach ($arNavChain as $itemChain):?>
		<span class="nav_arrow inline-block"></span>
		<span><?=$itemChain?></span>
	<?php endforeach ?>
</nav>
<section class="content">

		<section class="product_line">
				<figure class="product_item">
					

					<div class="product_item_pict">
						<a href="#">
							<img src="images/one-no-image.jpg" alt="BMW X3 2.0d" title="BMW X3 2.0d"/>
						</a>
					</div>
						<figcaption>
							<h3><a href="#">BMW X3 2.0d</a></h3>
                            <span class="product_item_price old_price">3 230 000 руб.</span>
							<p class="product_item_price">2 230 000 руб.</p>
							<a class="buy_button inverse inline-block pie" href="#">В корзину</a>
						</figcaption>
				</figure>
				<figure class="product_item">
					<div class="product_item_label gift"></div>

					<div class="product_item_pict">
						<a href="#">
							<img src="images/001_mercedes-benz_c-class_gray.jpg" alt="BMW X3 2.0d" title="BMW X3 2.0d"/>
						</a>
					</div>
						<figcaption>
							<h3><a href="#">BMW X3 2.0d</a></h3>
                            <span class="product_item_price dark_grey old_price">3 230 000 руб.</span>
							<p class="product_item_price dark_grey">2 230 000 руб.</p>
							<a class="buy_button inverse inline-block pie" href="#">В корзину</a>
						</figcaption>
				</figure>
				<figure class="product_item">
					<div class="product_item_label special_price"></div>
					<div class="product_item_pict">
						<a href="#">
							<img src="images/014_audi_a4_yellow.jpg" alt="BMW X3 2.0d" title="BMW X3 2.0d"/>
						</a>
						</div>
						<figcaption>
							<h3><a href="#">BMW X3 2.0d</a></h3>
                            <span class="product_item_price dark_grey old_price">3 230 000 руб.</span>
							<p class="product_item_price dark_grey">2 230 000 руб.</p>
							<a class="buy_button inverse inline-block pie" href="#">В корзину</a>
						</figcaption>
				</figure>
				<figure class="product_item">
					<div class="product_item_pict">
						<a href="#">
							<img src="images/one-no-image.jpg" alt="BMW X3 2.0d" title="BMW X3 2.0d"/>
						</a>
						</div>
						<figcaption>
							<h3><a href="#">BMW X3 2.0d</a></h3>
                            <span class="product_item_price dark_grey old_price">3 230 000 руб.</span>
							<p class="product_item_price dark_grey">2 230 000 руб.</p>
							<a class="buy_button inverse inline-block pie" href="#">В корзину</a>
						</figcaption>
				</figure>
		</section>
	
</section>
<?php

include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php';

?>