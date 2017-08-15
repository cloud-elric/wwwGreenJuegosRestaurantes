<?php
use yii\helpers\Url;

$this->title="Gano perdio";
?>
<style>
.jqp-controls{
	display: none !important;
	visibility: none !important;
}
</style>
	<img id="imagen-puzzle1" style="width:50%; display:none" src="<?=Url::base()?>/webAssets/images/imagen-rompecabezas.png" alt="imagen" class="jqPuzzldd" />	

<div class="container container-ribbon">
<<<<<<< HEAD
	<img id="imagen-puzzle" src="<?=Url::base()?>/webAssets/images/imagen-rompecabezas.png" alt="imagen" class="jqPuzzle" height="500" width="500"/>
	<a id="js_comenzar" class="btn btn-secondary btn-mecanica-comenzar" href="#">Comenzar</a>
=======
	<img id="imagen-puzzle" style="width:50%" src="<?=Url::base()?>/webAssets/images/imagen-rompecabezas.png" alt="imagen" class="jqPuzzle" />
	<a id="js_comenzar" class="btn btn-secondary" href="#">Comenzar</a>
>>>>>>> master
</div>

<script type="text/javascript">
	$(document).ready(function() {
		var settings = {
			rows: 3,                    // number of rows [3 ... 9]
			cols: 3,                    // number of columns [3 ... 9]
			hole: 9,                   // initial hole position [1 ... rows*columns]
			shuffle: false,             // initially show shuffled pieces [true|false]
			numbers: true,
			control: {
                toggleNumbers: false,
                counter: false,
                timer: true
			},
			success: {
                callback: function(results) {
					var count = $("#imagen-puzzle input").val();
					var minutos = count/60;
					//swal("Good job!", "Tu tiempo fue de "+count+" segundos", "success");
					swal({
						title: "Buen trabajo!!",
						text: "Tu tiempo fue de "+minutos.toFixed(1)+" minutos!",
						type: "success",
						showCancelButton: false,
						confirmButtonColor: "#F08D27",
						confirmButtonText: "Ver mi premio",
						closeOnConfirm: false
						},
						function(){
							//window.location.href = "<?=Url::base()?>/site/ganaste";
							$.ajax({
								url: "<?=Url::base()?>/site/guardar-tiempo",
								data: {token: "<?= $token?>", tiempo: count},
								type: "POST",
								success: function(resp){
									if(resp.status == "success"){
										window.location.href = '<?=Url::base()?>/site/mecanica?token='+'<?= $token ?>';
									}
								}
							});
						}
					);
                }
            }
		}

		var myTexts = {
            shuffleLabel:           'Comenzar!',
            toggleOriginalLabel:    'Original!',
        };
		$('#imagen-puzzle').jqPuzzle(settings, myTexts); // apply to all images

		$("#js_comenzar").on("click", function(){
			$(this).css('display','none');
			$(".jqp-controls>a").trigger("click");
		});
	});
</script>
