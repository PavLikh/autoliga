<?php

include $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';

<<<<<<< HEAD
$vehicleId = 0;
if ($_GET['vehicle']) {
	$vehicleId = $_GET['vehicle'];

	$arDetail = $detail->detailData($vehicleId);

	$photoName = $detail->picture($arDetail);

}

=======
>>>>>>> dev
?>

		
		
<nav class="nav_chain">
	<a href="/">Главная</a>
		<span class="nav_arrow inline-block">></span>
		<span>Покупателям</span>
</nav>
<section class="content">

		<h2>...Страница в разработке...</h2>
<<<<<<< HEAD
	
=======
			
>>>>>>> dev
</section>
<?php

include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php';

?>