<?php

namespace backend\modules\api\models;

use Yii;

/**
 * This is the model class for table "studenttest".
 *
 * @property integer $id
 * @property integer $idTest
 * @property integer $idProfile
 * @property string $date
 * @property string $startTime
 * @property string $endTime
 *
 * @property Profile $idProfile0
 * @property Test $idTest0
 */
class Studenttest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'studenttest';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idTest', 'idProfile', 'date', 'startTime', 'endTime'], 'required'],
            [['idTest', 'idProfile'], 'integer'],
            [['date', 'startTime', 'endTime'], 'safe'],
            [['idProfile'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['idProfile' => 'user_id']],
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
            'idProfile' => Yii::t('yii', 'Id Profile'),
            'date' => Yii::t('yii', 'Date'),
            'startTime' => Yii::t('yii', 'Start Time'),
            'endTime' => Yii::t('yii', 'End Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProfile0()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'idProfile']);
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
     * @return StudenttestQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StudenttestQuery(get_called_class());
    }
}
