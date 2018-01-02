<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "master_kec".
 *
 * @property int $id_kec
 * @property string $id_prop
 * @property string $id_kab
 * @property string $nm_kec
 *
 * @property MMitra[] $mMitras
 */
class MasterKec extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'master_kec';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_kec', 'id_prop', 'id_kab', 'nm_kec'], 'required'],
            [['id_kec'], 'integer'],
            [['id_prop'], 'string', 'max' => 2],
            [['id_kab'], 'string', 'max' => 4],
            [['nm_kec'], 'string', 'max' => 50],
            [['id_kec'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_kec' => 'Id Kec',
            'id_prop' => 'Id Prop',
            'id_kab' => 'Id Kab',
            'nm_kec' => 'Nm Kec',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMMitras()
    {
        return $this->hasMany(MMitra::className(), ['kecamatan' => 'id_kec']);
    }
}
