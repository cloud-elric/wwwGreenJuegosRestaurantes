<?php
use yii\helpers\Url;

$this->title="Instrucciones";
?>

<div class="container container-instrucciones">

	<div class="container container-instrucciones">
		<h3>Instrucciones</h3>

		<p>Resuelve el rompecabezas en el menor tiempo posible, haz clic en las piezas para moverlas y ponerlas en orden, entre mas pronto lo armes mayores serán los beneficios.</p>
		<img class="rompecabezas-instrucciones" src="<?=Url::base()?>/webAssets/images/rompecabezas-instrucciones.jpg" alt="">
		<a href="<?=Url::base() . "/site/mecanica?token=" . $token?>">
        <button class="btn btn-secondary ladda-button" data-style="zoom-in" type="button"><span class="ladda-label">Siguiente</span></button>
    </a>
	</div>



</div>
