<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cat_cupones".
 *
 * @property string $id_cupon
 * @property string $id_restaurante
 * @property string $txt_cupon
 * @property integer $b_usado
 *
 * @property CatRestaurantes $idRestaurante
 * @property EntUsuarios[] $entUsuarios
 */
class CatCupones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cat_cupones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_restaurante', 'txt_cupon'], 'required'],
            [['id_restaurante', 'b_usado'], 'integer'],
            [['txt_cupon'], 'string', 'max' => 50],
            [['id_restaurante'], 'exist', 'skipOnError' => true, 'targetClass' => CatRestaurantes::className(), 'targetAttribute' => ['id_restaurante' => 'id_restaurante']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_cupon' => 'Id Cupon',
            'id_restaurante' => 'Id Restaurante',
            'txt_cupon' => 'Txt Cupon',
            'b_usado' => 'B Usado',
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
    public function getEntUsuarios()
    {
        return $this->hasMany(EntUsuarios::className(), ['id_cupon' => 'id_cupon']);
    }
}
