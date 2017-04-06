<?php

namespace backend\modules\api\models;

use Yii;

/**
 * This is the model class for table "teststatement".
 *
 * @property integer $id
 * @property integer $idTest
 * @property integer $idStatement
 *
 * @property Test $idTest0
 * @property Statement $idStatement0
 */
class Teststatement extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'teststatement';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idTest', 'idStatement'], 'required'],
            [['idTest', 'idStatement'], 'integer'],
            [['idTest'], 'exist', 'skipOnError' => true, 'targetClass' => Test::className(), 'targetAttribute' => ['idTest' => 'id']],
            [['idStatement'], 'exist', 'skipOnError' => true, 'targetClass' => Statement::className(), 'targetAttribute' => ['idStatement' => 'id']],
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
            'idStatement' => Yii::t('yii', 'Id Statement'),
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
     * @return \yii\db\ActiveQuery
     */
    public function getIdStatement0()
    {
        return $this->hasOne(Statement::className(), ['id' => 'idStatement']);
    }

    /**
     * @inheritdoc
     * @return TeststatementQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TeststatementQuery(get_called_class());
    }
}
