<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "master_prop".
 *
 * @property int $id_prop
 * @property string $nm_prop
 *
 * @property MMitra[] $mMitras
 */
class MasterProp extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'master_prop';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_prop', 'nm_prop'], 'required'],
            [['id_prop'], 'integer'],
            [['nm_prop'], 'string', 'max' => 50],
            [['id_prop'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_prop' => 'Id Prop',
            'nm_prop' => 'Nm Prop',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMMitras()
    {
        return $this->hasMany(MMitra::className(), ['propinsi' => 'id_prop']);
    }
}
