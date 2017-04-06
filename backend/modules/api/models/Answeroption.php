<?php

namespace backend\modules\api\models;

use Yii;

/**
 * This is the model class for table "answeroption".
 *
 * @property integer $id
 * @property integer $idQuestion
 * @property string $name
 * @property integer $option
 *
 * @property Question $idQuestion0
 * @property Userresponse[] $userresponses
 */
class Answeroption extends \yii\db\ActiveRecord
{
    const SCENARIO_CREATE = 'create'; 
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'answeroption';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idQuestion', 'name', 'option'], 'required'],
            [['idQuestion', 'option'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['idQuestion'], 'exist', 'skipOnError' => true, 'targetClass' => Question::className(), 'targetAttribute' => ['idQuestion' => 'id']],
        ];
    }

    public function scenarios() 
    {
        $scenarios = parent::scenarios();
        $scenarios['create'] = ['idQuestion', 'name', 'option'];
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('yii', 'ID'),
            'idQuestion' => Yii::t('yii', 'Id Question'),
            'name' => Yii::t('yii', 'Name'),
            'option' => Yii::t('yii', '1:True 0:False'),
        ];
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
    public function getUserresponses()
    {
        return $this->hasMany(Userresponse::className(), ['idOpcionrespuesta' => 'id']);
    }

    /**
     * @inheritdoc
     * @return AnsweroptionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AnsweroptionQuery(get_called_class());
    }
}
