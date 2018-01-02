<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "master_desa".
 *
 * @property string $id_desa
 * @property string $id_prop
 * @property string $id_kab
 * @property string $id_kec
 * @property string $nm_desa
 */
class MasterDesa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'master_desa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_desa', 'id_prop', 'id_kab', 'id_kec', 'nm_desa'], 'required'],
            [['id_desa'], 'string', 'max' => 10],
            [['id_prop'], 'string', 'max' => 2],
            [['id_kab'], 'string', 'max' => 4],
            [['id_kec'], 'string', 'max' => 7],
            [['nm_desa'], 'string', 'max' => 50],
            [['id_desa'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_desa' => 'Id Desa',
            'id_prop' => 'Id Prop',
            'id_kab' => 'Id Kab',
            'id_kec' => 'Id Kec',
            'nm_desa' => 'Nm Desa',
        ];
    }
}
