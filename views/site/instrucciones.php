<?php
use yii\helpers\Url;

$this->title="Instrucciones";
?>

<div class="container container-ribbon">

	<div class="container container-960">
		<h3>Instrucciones</h3>
		<p>Resuelve el siguiente rompecabezar en el menor tiempo posible, entre mas pronto lo armes mayores seran los beneficios para disfrutar dias increibles en Fiesta Americana</p>
		<a href="<?=Url::base() . "/site/mecanica?token=" . $token?>">
        <button class="btn btn-secondary ladda-button" data-style="zoom-in" type="button"><span class="ladda-label">Siguiente</span></button>
    </a>
	</div>



</div>
