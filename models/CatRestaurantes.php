<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cat_restaurantes".
 *
 * @property string $id_restaurante
 * @property string $txt_nombre
 * @property string $txt_descripcion
 * @property string $b_habilitado
 *
 * @property CatPremios[] $catPremios
 * @property EntUsuarios[] $entUsuarios
 */
class CatRestaurantes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cat_restaurantes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['txt_nombre'], 'required'],
            [['b_habilitado'], 'integer'],
            [['txt_nombre', 'txt_descripcion'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_restaurante' => 'Id Restaurante',
            'txt_nombre' => 'Txt Nombre',
            'txt_descripcion' => 'Txt Descripcion',
            'b_habilitado' => 'B Habilitado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatPremios()
    {
        return $this->hasMany(CatPremios::className(), ['id_restaurante' => 'id_restaurante']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntUsuarios()
    {
        return $this->hasMany(EntUsuarios::className(), ['id_restaurante' => 'id_restaurante']);
    }
}
