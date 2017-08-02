<?php
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
$this->title = 'Restaurantes A&B';
?>

<div class="container container-home">
	<!-- Main content Wrapper -->
	<img class="logo-evento" src="<?=Url::base()?>/webAssets/images/logoportadarestaurante.png" alt="Recompensas a la Carta">

	<img class="floating-img botella" src="<?=Url::base()?>/webAssets/images/botella.png" alt="Recompensas a la Carta">

	<img class="floating-img sacacorchos" src="<?=Url::base()?>/webAssets/images/sacacorchos.png" alt="Recompensas a la Carta">

	<img class="floating-img libreta" src="<?=Url::base()?>/webAssets/images/libreta.png" alt="Recompensas a la Carta">

	<img class="floating-img logo-fa" src="<?=Url::base()?>/webAssets/images/logo-fa.png" alt="Recompensas a la Carta">

	<!-- Contenedor de las tarjetas -->
	<div class="js-tarjetas-contenedor">

		<!-- Seleccion de Tarjeta -->
		<div class="selecciona-tarjeta-wrapper">

            <?= Html::a('<span class="ladda-label">Comenzar</span>', ['site/registro'], ['class'=>'btn btn-secondary js-next-step ladda-button', 'data-style'=>'zoom-in']);?>

		</div>

		<!-- Termina Seleccion de Tarjeta -->

	</div>
	<!-- Fin contenedor de las tarjetas -->

</div>
<!-- Main content Wrapper -->
