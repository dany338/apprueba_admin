<?php

namespace backend\modules\api\models;

use Yii;

/**
 * This is the model class for table "testquestion".
 *
 * @property integer $id
 * @property integer $idTest
 * @property integer $idQuestion
 *
 * @property Question $idQuestion0
 * @property Test $idTest0
 */
class Testquestion extends \yii\db\ActiveRecord
{
    const SCENARIO_CREATE = 'create';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'testquestion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idTest', 'idQuestion'], 'required'],
            [['idTest', 'idQuestion'], 'integer'],
            [['idQuestion'], 'exist', 'skipOnError' => true, 'targetClass' => Question::className(), 'targetAttribute' => ['idQuestion' => 'id']],
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
            'idQuestion' => Yii::t('yii', 'Id Question'),
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['create'] = ['idTest', 'idQuestion'];
        return $scenarios;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdQuestion0()
    {
        return $this->hasOne(Question::className(), ['id' => 'idQuestion']);
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
     * @return TestquestionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TestquestionQuery(get_called_class());
    }
}
