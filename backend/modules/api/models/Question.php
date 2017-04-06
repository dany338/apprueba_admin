<?php

namespace backend\modules\api\models;

use Yii;

/**
 * This is the model class for table "question".
 *
 * @property integer $id
 * @property integer $idStatement
 * @property string $code
 * @property string $name
 * @property integer $answer
 *
 * @property Answeroption[] $answeroptions
 * @property Picture[] $pictures
 * @property Statement $idStatement0
 * @property Testquestion[] $testquestions
 * @property Userresponse[] $userresponses
 */
class Question extends \yii\db\ActiveRecord
{
    const SCENARIO_CREATE = 'create';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'question';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idStatement', 'answer'], 'integer'],
            [['code', 'name'], 'required'],
            [['name'], 'string'],
            [['code'], 'string', 'max' => 45],
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
            'idStatement' => Yii::t('yii', 'Id Statement'),
            'code' => Yii::t('yii', 'Code'),
            'name' => Yii::t('yii', 'Name'),
            'answer' => Yii::t('yii', 'Answer'),
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['create'] = ['idStatement', 'code', 'name'];
        return $scenarios;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnsweroptions()
    {
        return $this->hasMany(Answeroption::className(), ['idQuestion' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPictures()
    {
        return $this->hasMany(Picture::className(), ['idQuestion' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdStatement0()
    {
        return $this->hasOne(Statement::className(), ['id' => 'idStatement']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTestquestions()
    {
        return $this->hasMany(Testquestion::className(), ['idQuestion' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserresponses()
    {
        return $this->hasMany(Userresponse::className(), ['idQuestion' => 'id']);
    }

    /**
     * @inheritdoc
     * @return QuestionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new QuestionQuery(get_called_class());
    }
}
