<?php

namespace backend\modules\api\models;

use Yii;

/**
 * This is the model class for table "configuration".
 *
 * @property integer $id
 * @property integer $idTest
 * @property string $type
 * @property integer $count
 *
 * @property Test $idTest0
 */
class Configuration extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'configuration';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idTest', 'type', 'count'], 'required'],
            [['idTest', 'count'], 'integer'],
            [['type'], 'string'],
            [['idTest'], 'exist', 'skipOnError' => true, 'targetClass' => Test::className(), 'targetAttribute' => ['idTest' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('yii', 'ID'),
            'idTest' => Yii::t('yii', 'Id Test'),
            'type' => Yii::t('yii', 'Type'),
            'count' => Yii::t('yii', 'Count'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTest0()
    {
        return $this->hasOne(Test::className(), ['id' => 'idTest']);
    }

    /**
     * @inheritdoc
     * @return ConfigurationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ConfigurationQuery(get_called_class());
    }
}
