<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use borales\extensions\phoneInput\PhoneInputValidator;
use borales\extensions\phoneInput\PhoneInputBehavior;
use libphonenumber\PhoneNumberUtil;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberFormat;
use yii\web\HttpException;
use yii\base\UserException;
use yii\behaviors\BlameableBehavior;

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
 * @property string $no_hp
 * @property int $pendidikan
 * @property string $pengalaman_survei
 * @property int $penguasaan_kendaraan_motor
 * @property int $penguasaan_hp_android_ics_keatas
 * @property int $penguasaan_hp_android_ics_kebawah
 * @property int $penguasaan_hp_ios
 * @property int $penguasaan_hp_lainnya
 * @property int $id_user
 * @property string $foto
 * @property double $rating
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

    public function behaviors() {
        
        return [
            "xyz" => [
                "class" => PhoneInputBehavior::className(),
                    "attributes" => [
                        ActiveRecord::EVENT_BEFORE_INSERT => "no_hp",
                        ActiveRecord::EVENT_BEFORE_UPDATE => "no_hp",
                    ],
                    // "value" => function() { return Yii::$app->formatter->asDate($this->tanggal_lahir, "Y-MM-dd"); }
                    "value" => function() {
                        $swissNumberStr = $this->no_hp;
                        $phoneUtil = PhoneNumberUtil::getInstance();
                        $swissNumberProto = $phoneUtil->parse($swissNumberStr, "ID");
                        $formatNumber = $phoneUtil->format($swissNumberProto, PhoneNumberFormat::E164); 
                        return $formatNumber;
                    }
            ],
            // 'phoneInput' => PhoneInputBehavior::className(),
            "tanggalLahirBeforeSave" => [
                "class" => TimestampBehavior::className(),
                    "attributes" => [
                        ActiveRecord::EVENT_BEFORE_INSERT => "tanggal_lahir",
                        ActiveRecord::EVENT_BEFORE_UPDATE => "tanggal_lahir",
                    ],
                    "value" => function() { return Yii::$app->formatter->asDate($this->tanggal_lahir, "Y-MM-dd"); }
            ],
            "tanggalLahirAfterFind" => [
                   "class" => TimestampBehavior::className(),
                    "attributes" => [
                        ActiveRecord::EVENT_AFTER_FIND => "tanggal_lahir",
                    ],
                    "value" => function() { return Yii::$app->formatter->asDate($this->tanggal_lahir, "MMM dd, Y"); }
                    
            ],

            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'id_user',
                'updatedByAttribute' => 'id_user',
            ],

            
        ];
        
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama', 'jenis_kelamin', 'tanggal_lahir', 'propinsi', 'kabupaten', 'kecamatan', 'desa', 'no_hp', 'pendidikan', 'pengalaman_survei', 'penguasaan_kendaraan_motor', 'penguasaan_hp_android_ics_keatas', 'penguasaan_hp_android_ics_kebawah', 'penguasaan_hp_ios', 'penguasaan_hp_lainnya', 'foto', 'rating'], 'required'],
            [['jenis_kelamin', 'propinsi', 'kabupaten', 'kecamatan', 'pendidikan', 'penguasaan_kendaraan_motor', 'penguasaan_hp_android_ics_keatas', 'penguasaan_hp_android_ics_kebawah', 'penguasaan_hp_ios', 'penguasaan_hp_lainnya', 'id_user'], 'integer'],
            [['tanggal_lahir', 'id_user'], 'safe'],
            [['pengalaman_survei', 'foto'], 'string'],
            [['rating'], 'number'],
            [['nama'], 'string', 'max' => 256],
            [['desa'], 'string', 'max' => 10],
            [['no_hp'], 'string', 'max' => 20],
            [['pendidikan'], 'exist', 'skipOnError' => true, 'targetClass' => Pendidikan::className(), 'targetAttribute' => ['pendidikan' => 'id']],
            [['jenis_kelamin'], 'exist', 'skipOnError' => true, 'targetClass' => JenisKelamin::className(), 'targetAttribute' => ['jenis_kelamin' => 'id']],
            [['propinsi'], 'exist', 'skipOnError' => true, 'targetClass' => MasterProp::className(), 'targetAttribute' => ['propinsi' => 'id_prop']],
            [['kabupaten'], 'exist', 'skipOnError' => true, 'targetClass' => MasterKab::className(), 'targetAttribute' => ['kabupaten' => 'id_kab']],
            [['kecamatan'], 'exist', 'skipOnError' => true, 'targetClass' => MasterKec::className(), 'targetAttribute' => ['kecamatan' => 'id_kec']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
            [['desa'], 'exist', 'skipOnError' => true, 'targetClass' => MasterDesa::className(), 'targetAttribute' => ['desa' => 'id_desa']],
            // custom
            // ['penguasaan_kendaraan_motor', 'in', 'range' => [0, 1, 2, 3, 4, 5]],
            [['no_hp'], 'string'],
            // [['no_hp'], PhoneInputValidator::className()],
            [['no_hp'], PhoneInputValidator::className(), 'region' => ['ID']],
            [['nama'], 'string', 'length' => [4, 24]],
            [['penguasaan_kendaraan_motor', 'penguasaan_hp_android_ics_keatas', 'penguasaan_hp_android_ics_kebawah', 'penguasaan_hp_ios', 'penguasaan_hp_lainnya', 'rating'], 'number', 'min' => 0, 'max' => 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama Mitra',
            'jenis_kelamin' => 'Jenis Kelamin',
            'tanggal_lahir' => 'Tanggal Lahir',
            'propinsi' => 'Propinsi Domisili',
            'kabupaten' => 'Kabupaten Domisili',
            'kecamatan' => 'Kecamatan Domisili',
            'desa' => 'Desa/Kelurahan Domisili ',
            'no_hp' => 'Nomor HP',
            'pendidikan' => 'Pendidikan Terakhir yang Ditamatkan',
            'pengalaman_survei' => 'Pengalaman Survei di BPS',
            'penguasaan_kendaraan_motor' => 'Penguasaan Kendaraan Motor',
            'penguasaan_hp_android_ics_keatas' => 'Penguasaan HP Android versi Ice Cream Sandwich Keatas (termasuk ICS)',
            'penguasaan_hp_android_ics_kebawah' => 'Penguasaan HP Android versi Ice Cream Sandwich Kebawah',
            'penguasaan_hp_ios' => 'Penguasaan HP Apple/IOS',
            'penguasaan_hp_lainnya' => 'Penguasaan HP Jenis Lainnya',
            'id_user' => 'Id User',
            'foto' => 'Foto Mitra & KTP',
            'rating' => 'Rating Hasil Pekerjaan Mitra',
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
