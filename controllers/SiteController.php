<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\EntUsuarios;
use yii\db\Expression;
use app\models\ViewPremiosRestantes;
use app\models\RelUsuarioPremio;
use app\models\ViewUsuarioDatos;
use yii\web\Response;
use app\models\WebConstantes;
use app\models\CatCupones;

class SiteController extends Controller {
	public $enableCsrfValidation = false;
	/**
	 * @inheritdoc
	 */
	public function behaviors() {
		return [
				'access' => [
						'class' => AccessControl::className (),
						'only' => [
								'logout'
						],
						'rules' => [
								[
										'actions' => [
												'logout'
										],
										'allow' => true,
										'roles' => [
												'@'
										]
								]
						]
				],
				'verbs' => [
						'class' => VerbFilter::className (),
						'actions' => [
								'logout' => [
										'post'
								]
						]
				]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function actions() {
		return [
				'error' => [
						'class' => 'yii\web\ErrorAction'
				],
				'captcha' => [
						'class' => 'yii\captcha\CaptchaAction',
						'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null
				]
		];
	}

	/**
	 * Displays homepage.
	 *
	 * @return string
	 */
	public function actionIndex() {
		$usuario = new EntUsuarios ();

		return $this->render ( 'inicio' );
	}

	public function actionRegistro(){
		$usuario = new EntUsuarios ();

		if ($usuario->load ( Yii::$app->request->post () )) {
			// Asigna el restaurante
			$usuario->id_restaurante = WebConstantes::ENTRE_FUEGOS;
			$cupon = CatCupones::find()->where(['txt_cupon'=>$usuario->txt_codigo])->one();
			if($cupon){
				$cuponUsado = EntUsuarios::find()->where(['id_cupon'=>$cupon->id_cupon])->andWhere(['id_restaurante'=>WebConstantes::ENTRE_FUEGOS])->one();
				if(!$cuponUsado){
				$usuario->id_cupon = $cupon->id_cupon;
				$usuario->txt_token = 'usr_'.md5($usuario->txt_nombre_completo.microtime ()) ;
				if ($usuario->save ()) {

					return $this->redirect(['instrucciones', 'token'=>$usuario->txt_token]);
					}
				}else{
					$usuario->addError('txt_codigo', 'Código no válido');
				}				
			}else{
				$usuario->addError('txt_codigo', 'Código no válido');				
			}
		}

		return $this->render ( 'registro', [
				'usuario' => $usuario
		] );
	}

	public function actionUsuarioGano($token=null){
		$usuario = EntUsuarios::find()->where(["txt_token"=>$token])->one();

		if($usuario){
			$usuario->b_gano = 1;
			$usuario->save();

			$link = Yii::$app->urlManager->createAbsoluteUrl ( [
								'site/ver-premio?token=' . $usuario->txt_token
			] );

			$urlCorta = $this->getShortUrl($link);

			$message = urlencode ( "Felicidades tu habilidad te ha recompensado, canjea tu cupón dando click en esta liga: " . $urlCorta );

			$this->sendSMS($usuario->txt_telefono_celular, $message);
		}else{

		}

		return $this->redirect ( ['index'] );
	}



	private function sendSMS($tel='', $message=''){

		$urlAutenticate = 'http://sms-tecnomovil.com/SvtSendSms?username=PIXERED&password=Pakabululu01&message=' . $message . '&numbers=' . $tel;
		//$sms = file_get_contents ( $url );

		#$urlAutenticate = 'http://dgom.mobi';

		$ch = curl_init ();

		curl_setopt ( $ch, CURLOPT_URL, $urlAutenticate );

		curl_setopt ( $ch, CURLOPT_POSTREDIR, 3 );
		curl_setopt ( $ch, CURLOPT_FOLLOWLOCATION, true );

		// in real life you should use something like:
		// curl_setopt($ch, CURLOPT_POSTFIELDS,
		// http_build_query(array('postvar1' => 'value1')));

		// receive server response ...
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );

		$server_output = curl_exec ( $ch );

		curl_close ( $ch );

		return $server_output;

	}

public function actionTestGetUrl(){
	echo $this->getShortUrl('http://localhost/wwwGreenSacromonte/web/site/slot-machine?token=usr_bf818b2e789154f2a9be253022c655db');
}

private function getShortUrl($url) {
		$urlAutenticate = 'http://dgom.mobi';

		$ch = curl_init ();

		curl_setopt ( $ch, CURLOPT_URL, $urlAutenticate );
		curl_setopt ( $ch, CURLOPT_CUSTOMREQUEST, 'POST' );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, 'user=userGreenSaco&pass=passGreenSacro&app=GreenSacro&url=' . $url );
		curl_setopt ( $ch, CURLOPT_POSTREDIR, 3 );
		curl_setopt ( $ch, CURLOPT_FOLLOWLOCATION, true );

		// in real life you should use something like:
		// curl_setopt($ch, CURLOPT_POSTFIELDS,
		// http_build_query(array('postvar1' => 'value1')));

		// receive server response ...
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );

		$server_output = curl_exec ( $ch );

		curl_close ( $ch );

		return $server_output;
	}

	public function actionVerPremio($token=""){
		$usuario = EntUsuarios::find()->where(["txt_token"=>$token])->one();

		if($usuario){
			return $this->render('premio');
		}



	}

	/**
	 * Guarda la informacion
	 */
	public function actionGuardarInformacion($tokenEvento=null) {

		$usuario = new EntUsuarios ();


		if ($usuario->load ( Yii::$app->request->post () )) {
				$usuario->txt_token = "usr_" . md5 ( uniqid ( "usr_" ) ) . uniqid ();
			if ($usuario->save ()) {

			}

			return $this->renderAjax ( 'mucha-suerte' );
		}
	}

	private function getToken($string='token_'){
		$token = $string . md5 ( uniqid ( $string ) ) . uniqid ();
		return $token;
	}

	/**
	 * Descarga un csv con la informacion necesaria
	 */
	public function actionDescargarRegistros3289lsdfadsd33k9ffd3jl(){
		$usuarios = ViewUsuarioDatos::find()->all();

		$arrayCsv = [ ];
		$i = 0;

		foreach ( $usuarios as $data ) {

			$arrayCsv [$i] ['nombreCompleto'] = $data->txt_nombre_completo;
			$arrayCsv [$i] ['nombreRestaurante'] = $data->txt_nombre_restaurante;
			$arrayCsv [$i] ['telefonoCelular'] = $data->txt_telefono_celular;
			$arrayCsv [$i] ['codigoPostal'] = $data->txt_cp;
			$arrayCsv [$i] ['numEdad'] = $data->num_edad;
			$arrayCsv [$i] ['fchRegistro'] = $data->fch_registro;
			$arrayCsv [$i] ['aceptoTerminos'] = $data->acepto_terminos;
			$arrayCsv [$i] ['premio'] = $data->txt_premio;


			$i++;
		}


	//print_r($arrayCsv );
	//exit ();

		$this->downloadSendHeaders ( 'reporte.csv' );

		echo $this->array2Csv ( $arrayCsv );
		die();

	}

		private function array2Csv($array) {
		if (count ( $array ) == 0) {
			return null;
		}
		ob_start();
		$df = fopen ( "php://output", "w" );
		fputcsv ( $df, [
				'Nombre completo',
				'Nombre restaurante',				
				'Telefono',
				'C.P.',
				'Edad',
				'Fecha registro',
				'Acepto terminos',
				'Premio'
		]
		 );

		foreach ( $array as $row ) {
			fputcsv ( $df, $row );
		}

		fclose ( $df );
		return ob_get_clean();
	}




	private function downloadSendHeaders($filename) {
		// disable caching
		$now = gmdate ( "D, d M Y H:i:s" );
		// header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
		header ( "Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate" );
		header ( "Last-Modified: {$now} GMT" );

		// force download
		header ( "Content-Type: application/force-download" );
		header ( "Content-Type: application/octet-stream" );
		// comentario sin sentido
		header ( "Content-Type: application/download" );

		// disposition / encoding on response body
		header ( "Content-Disposition: attachment;filename={$filename}" );
		header ( "Content-Transfer-Encoding: binary" );
	}

	/**
	 * Cambia el formato de la fecha
	 *
	 * @param unknown $string
	 */
	public static function changeFormatDate($string) {
		$date = date_create ( $string );
		return date_format ( $date, "d-M-Y" );
	}

	/**
	 * Obtenemos la fecha actual para almacenarla
	 *
	 * @return string
	 */
	private function getFechaActual() {

		// Inicializamos la fecha y hora actual
		$fecha = date ( 'Y-m-d H:i:s', time () );
		return $fecha;
	}


	public function actionMecanica($token=''){
		$usuario = EntUsuarios::find()->where(["txt_token"=>$token])->one();

		if($usuario){
			if($usuario->b_tiempo > 0){

				$relPremio = RelUsuarioPremio::find()->where(['id_usuario'=>$usuario->id_usuario])->one();


				return $this->redirect(['premios',
					'token' => $relPremio->txt_token
				]);
			}else{
				return $this->render("mecanica", ['token'=>$token]);
			}
		}
	}

	public function actionInstrucciones($token=''){
		$usuario = EntUsuarios::find()->where(["txt_token"=>$token])->one();

		if($usuario){
			return $this->render("instrucciones", ['token'=>$token]);
		}

	}

	public function actionGuardarTiempo(){
		Yii::$app->response->format = Response::FORMAT_JSON;

		if(isset($_POST['token']) && isset($_POST['tiempo'])){
			$usuario = EntUsuarios::find()->where(['txt_token'=>$_POST['token']])->one();
			if($usuario){


				$usuario->b_tiempo = $_POST['tiempo'];
				if($usuario->save()){

				if($usuario->b_tiempo < WebConstantes::TIEMPO_PREMIO_MAYOR){
					$idPremio = WebConstantes::DOS_POR_UNO;
				}else{
					$idPremio = WebConstantes::DESCUENTO;
				}

				$relPremioUsuario = new RelUsuarioPremio();
				$relPremioUsuario->id_premio = $idPremio;
				$relPremioUsuario->id_usuario = $usuario->id_usuario;
				$relPremioUsuario->txt_token = "pre_" . md5 ( uniqid ( "pre_" ) ) . uniqid ();
				$relPremioUsuario->fch_premio = $this->getFechaActual();
				$relPremioUsuario->save();

					return ['status' => 'success'];
				}
			}
		}
		return ['status' => 'error'];
	}

	public function actionPremios($token = null){

		$relPremio = RelUsuarioPremio::find()->where(['txt_token'=>$token])->one();


		return $this->render('verPremio', [
			'premio' => $relPremio->idPremio
		]);
	}

}
