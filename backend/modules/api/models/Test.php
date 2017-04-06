<?php

namespace backend\modules\api\models;

use Yii;

/**
 * This is the model class for table "test".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 *
 * @property Configuration[] $configurations
 * @property Studenttest[] $studenttests
 * @property Testquestion[] $testquestions
 * @property Teststatement[] $teststatements
 */
class Test extends \yii\db\ActiveRecord
{
    const SCENARIO_CREATE = 'create';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'test';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['code'], 'string', 'max' => 45],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('yii', 'ID'),
            'code' => Yii::t('yii', 'Code'),
            'name' => Yii::t('yii', 'Name'),
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
    public function getConfigurations()
    {
        return $this->hasMany(Configuration::className(), ['idTest' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudenttests()
    {
        return $this->hasMany(Studenttest::className(), ['idTest' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTestquestions()
    {
        return $this->hasMany(Testquestion::className(), ['idTest' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeststatements()
    {
        return $this->hasMany(Teststatement::className(), ['idTest' => 'id']);
    }

    /**
     * @inheritdoc
     * @return TestQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TestQuery(get_called_class());
    }
}
