<?php

namespace backend\modules\api\models;

use Yii;

/**
 * This is the model class for table "city".
 *
 * @property integer $id
 * @property string $codeDane
 * @property integer $idCountry
 * @property string $name
 * @property string $group
 *
 * @property State $idState0
 * @property School[] $schools
 * @property University[] $universities
 */
class City extends \yii\db\ActiveRecord
{
    const SCENARIO_CREATE = 'create';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codeDane', 'idState', 'name', 'group'], 'required'],
            [['idState'], 'integer'],
            [['group'], 'string'],
            [['codeDane', 'name'], 'string', 'max' => 45],
            [['idState'], 'exist', 'skipOnError' => true, 'targetClass' => State::className(), 'targetAttribute' => ['idState' => 'id']],
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
            'idState' => Yii::t('yii', 'Id Country'),
            'name' => Yii::t('yii', 'Name'),
            'group' => Yii::t('yii', 'Group'),
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['create'] = ['codeDane', 'idState', 'name'];
        return $scenarios;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdState0()
    {
        return $this->hasOne(State::className(), ['id' => 'idState']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchools()
    {
        return $this->hasMany(School::className(), ['idCity' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUniversities()
    {
        return $this->hasMany(University::className(), ['idCity' => 'id']);
    }

    /**
     * @inheritdoc
     * @return CityQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CityQuery(get_called_class());
    }
}
