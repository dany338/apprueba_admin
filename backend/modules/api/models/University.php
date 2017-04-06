<?php

namespace backend\modules\api\models;

use Yii;

/**
 * This is the model class for table "university".
 *
 * @property integer $id
 * @property integer $idCity
 * @property string $code
 * @property string $name
 *
 * @property Career[] $careers
 * @property City $idCity0
 */
class University extends \yii\db\ActiveRecord
{
    const SCENARIO_CREATE = 'create';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'university';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idCity'], 'integer'],
            [['code', 'name'], 'required'],
            [['code'], 'string', 'max' => 45],
            [['name'], 'string', 'max' => 100],
            [['idCity'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['idCity' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('yii', 'ID'),
            'idCity' => Yii::t('yii', 'Id City'),
            'code' => Yii::t('yii', 'Code'),
            'name' => Yii::t('yii', 'Name'),
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['create'] = ['code', 'name'];
        return $scenarios;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCareers()
    {
        return $this->hasMany(Career::className(), ['idUniversity' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCity0()
    {
        return $this->hasOne(City::className(), ['id' => 'idCity']);
    }

    /**
     * @inheritdoc
     * @return UniversityQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UniversityQuery(get_called_class());
    }
}
