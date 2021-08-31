<?php

include $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';
$arCatalog = $catalog->productLine();

?>


<<<<<<< HEAD
		<section class="tagline">
			<div id="top">
        		<h1>Режим просмотра</h1>

    		</div>
		</section>
=======
>>>>>>> dev
		<section class="content">
			<div class="advert">
				<div class="banner">
				<img src="images/banner_mercedes_c.jpg" alt="" title="" />
					<div class="banner_content">
						<h1>Новый Mercedes C-класс</h1>
						<h3></h3>
						<h2>Подчеркнуто динамичный характер. С легкостью преодолевает любые трудности. Откройте для себя превосходные качества нового седана C-класса. Динамичного, элегантнго и роскошного как никогда <a href="catalog.php?model[]=1&purpose=1" class="detail_link">подробнее</a><!-- <a href="#1" class="detail_link">подробнее</a> --></h2>
					</div>
				</div>
			</div>
			<h2 class="push_right">Подборка недели</h2>

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

                    <img src="images/<?=$detail->picture($item)?>.jpg" alt="<?=$item['mark']. ' ' .$item['model']?>" title="<?=$item['mark']. ' ' .$item['model']?>"/>
                			</div>
                		</a>
                		<figcaption>
                  			<h3><a href="detail.php?vehicle=<?=$item['id'] ?>"><?=$item['mark'] . ' ' . $item['model'] ?></a></h3>
                 			<span class="product_item_price old_price"><?=($item['discount_id'] == 2) ? number_format($item['price'], 0, '.', ' ') : ''?></span>
                			<p class="product_item_price"><?=number_format(($item['discount_id'] == 2) ? $item['price'] * 0.7 : $item['price'], 0, '.', ' ') ?></p>

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
