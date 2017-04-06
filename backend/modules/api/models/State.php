<?php

namespace backend\modules\api\models;

use Yii;

/**
 * This is the model class for table "state".
 *
 * @property integer $id
 * @property string $codeDane
 * @property integer $idCountry
 * @property string $name
 *
 * @property City[] $cities
 * @property Country $idCountry0
 */
class State extends \yii\db\ActiveRecord
{
    const SCENARIO_CREATE = 'create';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'state';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codeDane', 'idCountry', 'name'], 'required'],
            [['idCountry'], 'integer'],
            [['codeDane', 'name'], 'string', 'max' => 45],
            [['idCountry'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['idCountry' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('yii', 'ID'),
            'codeDane' => Yii::t('yii', 'Code Dane'),
            'idCountry' => Yii::t('yii', 'Id Country'),
            'name' => Yii::t('yii', 'Name'),
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['create'] = ['codeDane', 'idCountry', 'name'];
        return $scenarios;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCities()
    {
        return $this->hasMany(City::className(), ['idCountry' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCountry0()
    {
        return $this->hasOne(Country::className(), ['id' => 'idCountry']);
    }

    /**
     * @inheritdoc
     * @return StateQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StateQuery(get_called_class());
    }
}
