<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cat_cupones".
 *
 * @property string $id_cupon
 * @property string $txt_cupon
 * @property integer $b_usado
 *
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
            [['txt_cupon'], 'required'],
            [['b_usado'], 'integer'],
            [['txt_cupon'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_cupon' => 'Id Cupon',
            'txt_cupon' => 'Txt Cupon',
            'b_usado' => 'B Usado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntUsuarios()
    {
        return $this->hasMany(EntUsuarios::className(), ['id_cupon' => 'id_cupon']);
    }
}
