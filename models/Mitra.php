<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mitra".
 *
 * @property int $id
 * @property string $nama
 * @property int $jenis_kelamin
 * @property string $tanggal_lahir
 * @property int $propinsi
 * @property int $kabupaten
 * @property int $kecamatan
 * @property string $desa
 * @property int $no_hp
 * @property int $pendidikan
 * @property string $pengalaman_survei
 * @property int $penguasaan_kendaraan_motor
 * @property int $penguasaan_hp_android_ics_keatas
 * @property int $penguasaan_hp_android_ics_kebawah
 * @property int $penguasaan_hp_ios
 * @property int $penguasaan_hp_lainnya
 * @property int $id_user
 * @property string $foto
 *
 * @property Pendidikan $pendidikan0
 * @property JenisKelamin $jenisKelamin
 * @property MasterProp $propinsi0
 * @property MasterKab $kabupaten0
 * @property MasterKec $kecamatan0
 * @property User $user
 * @property MasterDesa $desa0
 */
class Mitra extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mitra';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama', 'jenis_kelamin', 'tanggal_lahir', 'propinsi', 'kabupaten', 'kecamatan', 'desa', 'no_hp', 'pendidikan', 'pengalaman_survei', 'penguasaan_kendaraan_motor', 'penguasaan_hp_android_ics_keatas', 'penguasaan_hp_android_ics_kebawah', 'penguasaan_hp_ios', 'penguasaan_hp_lainnya', 'id_user', 'foto'], 'required'],
            [['jenis_kelamin', 'propinsi', 'kabupaten', 'kecamatan', 'no_hp', 'pendidikan', 'penguasaan_kendaraan_motor', 'penguasaan_hp_android_ics_keatas', 'penguasaan_hp_android_ics_kebawah', 'penguasaan_hp_ios', 'penguasaan_hp_lainnya', 'id_user'], 'integer'],
            [['tanggal_lahir'], 'safe'],
            [['pengalaman_survei', 'foto'], 'string'],
            [['nama'], 'string', 'max' => 256],
            [['desa'], 'string', 'max' => 10],
            [['pendidikan'], 'exist', 'skipOnError' => true, 'targetClass' => Pendidikan::className(), 'targetAttribute' => ['pendidikan' => 'id']],
            [['jenis_kelamin'], 'exist', 'skipOnError' => true, 'targetClass' => JenisKelamin::className(), 'targetAttribute' => ['jenis_kelamin' => 'id']],
            [['propinsi'], 'exist', 'skipOnError' => true, 'targetClass' => MasterProp::className(), 'targetAttribute' => ['propinsi' => 'id_prop']],
            [['kabupaten'], 'exist', 'skipOnError' => true, 'targetClass' => MasterKab::className(), 'targetAttribute' => ['kabupaten' => 'id_kab']],
            [['kecamatan'], 'exist', 'skipOnError' => true, 'targetClass' => MasterKec::className(), 'targetAttribute' => ['kecamatan' => 'id_kec']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
            [['desa'], 'exist', 'skipOnError' => true, 'targetClass' => MasterDesa::className(), 'targetAttribute' => ['desa' => 'id_desa']],
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
            'jenis_kelamin' => 'Jenis Kelamin',
            'tanggal_lahir' => 'Tanggal Lahir',
            'propinsi' => 'Propinsi',
            'kabupaten' => 'Kabupaten',
            'kecamatan' => 'Kecamatan',
            'desa' => 'Desa',
            'no_hp' => 'No Hp',
            'pendidikan' => 'Pendidikan',
            'pengalaman_survei' => 'Pengalaman Survei',
            'penguasaan_kendaraan_motor' => 'Penguasaan Kendaraan Motor',
            'penguasaan_hp_android_ics_keatas' => 'Penguasaan Hp Android Ics Keatas',
            'penguasaan_hp_android_ics_kebawah' => 'Penguasaan Hp Android Ics Kebawah',
            'penguasaan_hp_ios' => 'Penguasaan Hp Ios',
            'penguasaan_hp_lainnya' => 'Penguasaan Hp Lainnya',
            'id_user' => 'Id User',
            'foto' => 'Foto',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPendidikan0()
    {
        return $this->hasOne(Pendidikan::className(), ['id' => 'pendidikan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJenisKelamin()
    {
        return $this->hasOne(JenisKelamin::className(), ['id' => 'jenis_kelamin']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPropinsi0()
    {
        return $this->hasOne(MasterProp::className(), ['id_prop' => 'propinsi']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKabupaten0()
    {
        return $this->hasOne(MasterKab::className(), ['id_kab' => 'kabupaten']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKecamatan0()
    {
        return $this->hasOne(MasterKec::className(), ['id_kec' => 'kecamatan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDesa0()
    {
        return $this->hasOne(MasterDesa::className(), ['id_desa' => 'desa']);
    }
}
