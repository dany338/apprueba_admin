<?php

namespace backend\modules\api\models;

use Yii;

/**
 * This is the model class for table "career".
 *
 * @property integer $id
 * @property integer $idUniversity
 * @property string $code
 * @property string $name
 *
 * @property University $idUniversity0
 * @property Profile[] $profiles
 */
class Career extends \yii\db\ActiveRecord
{
    const SCENARIO_CREATE = 'create';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'career';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idUniversity'], 'integer'],
            [['code', 'name'], 'required'],
            [['code'], 'string', 'max' => 45],
            [['name'], 'string', 'max' => 255],
            [['idUniversity'], 'exist', 'skipOnError' => true, 'targetClass' => University::className(), 'targetAttribute' => ['idUniversity' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('yii', 'ID'),
            'idUniversity' => Yii::t('yii', 'Id University'),
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
    public function getIdUniversity0()
    {
        return $this->hasOne(University::className(), ['id' => 'idUniversity']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles()
    {
        return $this->hasMany(Profile::className(), ['idCarrera' => 'id']);
    }

    /**
     * @inheritdoc
     * @return CareerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CareerQuery(get_called_class());
    }
}
