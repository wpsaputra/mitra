<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jenis_kelamin".
 *
 * @property int $id
 * @property string $nama
 *
 * @property Mitra[] $mitras
 */
class JenisKelamin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jenis_kelamin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama'], 'required'],
            [['nama'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMitras()
    {
        return $this->hasMany(Mitra::className(), ['jenis_kelamin' => 'id']);
    }
}
