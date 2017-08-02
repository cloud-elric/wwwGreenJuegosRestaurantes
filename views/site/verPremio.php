<?php
use yii\helpers\Url;

$this->title="Gracias por participar";
?>
 <div class="container container-ribbon">
   <img class="logo-restaurante" src="<?=Url::base()?>/webAssets/images/logorestaurante.png" alt="Entre-Fuegos">
<!-- Premio contenedor  -->
	<div class="js-premio-contenedor" style="text-align:center">
		<div class="premio js-premio-ajax">
			<h2><?=$premio->txt_nombre?></h2>
		</div>
    <a class="btn btn-primary" href="<?=Url::base()?>">Imprimir</a>
		<a class="btn btn-secondary" href="<?=Url::base()?>">Finalizar</a>
	</div>
	<!-- Fin premio contenedor -->

</div>
<img class="logo" src="<?=Url::base()?>/webAssets/images/logo-fa.png" alt="Fiesta Americana">
