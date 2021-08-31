<?php

include $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';

?>

		
		
<nav class="nav_chain">
	<a href="/">Главная</a>
	<?php foreach ($arNavChain as $itemChain):?>
		<span class="nav_arrow inline-block"></span>
		<span><?=$itemChain?></span>
	<?php endforeach ?>
</nav>
<section class="content">

	
</section>
<?php

include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php';

?>