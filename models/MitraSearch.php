<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Mitra;

/**
 * MitraSearch represents the model behind the search form of `app\models\Mitra`.
 */
class MitraSearch extends Mitra
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'jenis_kelamin', 'propinsi', 'kabupaten', 'kecamatan', 'pendidikan', 'penguasaan_kendaraan_motor', 'penguasaan_hp_android_ics_keatas', 'penguasaan_hp_android_ics_kebawah', 'penguasaan_hp_ios', 'penguasaan_hp_lainnya', 'id_user'], 'integer'],
            [['nama', 'tanggal_lahir', 'desa', 'pengalaman_survei', 'foto', 'no_hp'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Mitra::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'jenis_kelamin' => $this->jenis_kelamin,
            'tanggal_lahir' => $this->tanggal_lahir,
            'propinsi' => $this->propinsi,
            'kabupaten' => $this->kabupaten,
            'kecamatan' => $this->kecamatan,
            'no_hp' => $this->no_hp,
            'pendidikan' => $this->pendidikan,
            'penguasaan_kendaraan_motor' => $this->penguasaan_kendaraan_motor,
            'penguasaan_hp_android_ics_keatas' => $this->penguasaan_hp_android_ics_keatas,
            'penguasaan_hp_android_ics_kebawah' => $this->penguasaan_hp_android_ics_kebawah,
            'penguasaan_hp_ios' => $this->penguasaan_hp_ios,
            'penguasaan_hp_lainnya' => $this->penguasaan_hp_lainnya,
            'id_user' => $this->id_user,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'desa', $this->desa])
            ->andFilterWhere(['like', 'pengalaman_survei', $this->pengalaman_survei])
            ->andFilterWhere(['like', 'foto', $this->foto]);

        return $dataProvider;
    }
}
