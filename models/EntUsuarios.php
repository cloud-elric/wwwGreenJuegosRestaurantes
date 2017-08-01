<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ent_usuarios".
 *
 * @property string $id_usuario
 * @property string $txt_nombre_completo
 * @property string $txt_telefono_celular
 * @property string $txt_cp
 * @property string $txt_token
 * @property string $num_edad
 * @property string $txt_codigo
 * @property string $txt_num_empleado
 * @property string $fch_registro
 * @property string $b_aceptar_terminos
 * @property string $b_gano
 */
class EntUsuarios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ent_usuarios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['txt_nombre_completo', 'txt_telefono_celular', 'txt_cp', 'txt_token', 'num_edad', 'txt_codigo', 'txt_num_empleado'], 'required'],
            [['num_edad', 'b_aceptar_terminos', 'b_gano'], 'integer'],
            [['fch_registro'], 'safe'],
            [['txt_nombre_completo'], 'string', 'max' => 150],
            [['txt_telefono_celular'], 'string', 'max' => 10],
            [['txt_cp'], 'string', 'max' => 5],
            [['txt_token'], 'string', 'max' => 70],
            [['txt_codigo', 'txt_num_empleado'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_usuario' => 'Id Usuario',
            'txt_nombre_completo' => 'Nombre completo',
            'txt_telefono_celular' => 'Teléfono celular',
            'txt_cp' => 'Código postal',
            'txt_token' => 'Txt Token',
            'num_edad' => 'Edad',
            'txt_codigo' => 'Código',
            'txt_num_empleado' => '# de empleado',
            'fch_registro' => 'Fch Registro',
            'b_aceptar_terminos' => 'B Aceptar Terminos',
            'b_gano' => 'B Gano',
        ];
    }

     /** 
    * @return \yii\db\ActiveQuery 
    */ 
   public function getIdRestaurante() 
   { 
       return $this->hasOne(CatRestaurantes::className(), ['id_restaurante' => 'id_restaurante']); 
   } 
 
   /** 
    * @return \yii\db\ActiveQuery 
    */ 
   public function getRelUsuarioPremios() 
   { 
       return $this->hasMany(RelUsuarioPremio::className(), ['id_usuario' => 'id_usuario']); 
   } 
 
   /** 
    * @return \yii\db\ActiveQuery 
    */ 
   public function getIdPremios() 
   { 
       return $this->hasMany(CatPremios::className(), ['id_premio' => 'id_premio'])->viaTable('rel_usuario_premio', ['id_usuario' => 'id_usuario']); 
   } 
}
