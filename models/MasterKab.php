<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "master_kab".
 *
 * @property int $id_kab
 * @property string $id_prop
 * @property string $nm_kab
 *
 * @property MMitra[] $mMitras
 */
class MasterKab extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'master_kab';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_kab', 'id_prop', 'nm_kab'], 'required'],
            [['id_kab', 'id_prop'], 'integer'],
            [['nm_kab'], 'string', 'max' => 50],
            [['id_kab'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_kab' => 'Id Kab',
            'id_prop' => 'Id Prop',
            'nm_kab' => 'Nm Kab',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMMitras()
    {
        return $this->hasMany(MMitra::className(), ['kabupaten' => 'id_kab']);
    }
}
