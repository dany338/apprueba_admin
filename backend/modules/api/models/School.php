<?php

namespace backend\modules\api\models;

use Yii;

/**
 * This is the model class for table "school".
 *
 * @property integer $id
 * @property integer $idCity
 * @property string $code
 * @property string $name
 *
 * @property Profile[] $profiles
 * @property City $idCity0
 */
class School extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'school';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idCity', 'code', 'name'], 'required'],
            [['idCity'], 'integer'],
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles()
    {
        return $this->hasMany(Profile::className(), ['idColegio' => 'id']);
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
     * @return SchoolQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SchoolQuery(get_called_class());
    }
}
