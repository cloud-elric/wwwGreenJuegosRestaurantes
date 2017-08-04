<?php
use yii\helpers\Url;

$this->title="Gracias por participar";
?>
 <div class="container container-ribbon">
   <img class="logo-restaurante" src="<?=Url::base()?>/webAssets/images/logorestaurante.png" alt="Entre-Fuegos">
<!-- Premio contenedor  -->
	<div class="js-premio-contenedor" style="text-align:center">
		<div class="premio js-premio-ajax">

      <h3> Felicidades </h3>
      <p>Tu habilidad te ha recompensando</p>
      <h2><?=$premio->txt_nombre?></h2>
      <p>No olvides imprimir tu certificado</p>
		</div>
    <a class="btn btn-primary" href="<?=Url::base()?>/site/imprimir-certificado?token<?=$token?>" target="_blank">Imprimir Certificado</a>
		<a class="btn btn-secondary" href="<?=Url::base()?>">Finalizar</a>
	</div>
	<!-- Fin premio contenedor -->

</div>
<img class="logo" src="<?=Url::base()?>/webAssets/images/logo-fa.png" alt="Fiesta Americana">
