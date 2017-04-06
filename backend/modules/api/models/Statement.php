<?php

namespace backend\modules\api\models;

use Yii;

/**
 * This is the model class for table "statement".
 *
 * @property integer $id
 * @property integer $idCategory
 * @property string $code
 * @property string $description
 * @property integer $count
 *
 * @property Picture[] $pictures
 * @property Question[] $questions
 * @property Category $idCategory0
 * @property Teststatement[] $teststatements
 */
class Statement extends \yii\db\ActiveRecord
{
    const SCENARIO_CREATE = 'create'; 
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'statement';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idCategory', 'code', 'description'], 'required'],
            [['idCategory', 'count'], 'integer'],
            [['description'], 'string'],
            [['code'], 'string', 'max' => 45],
            [['idCategory'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['idCategory' => 'id']],
        ];
    }

    public function scenarios() 
    {
        $scenarios = parent::scenarios();
        $scenarios['create'] = ['idCategory', 'code', 'description'];
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('yii', 'ID'),
            'idCategory' => Yii::t('yii', 'Id Category'),
            'code' => Yii::t('yii', 'Code'),
            'description' => Yii::t('yii', 'Description'),
            'count' => Yii::t('yii', 'Count'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPictures()
    {
        return $this->hasMany(Picture::className(), ['idStatement' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions()
    {
        return $this->hasMany(Question::className(), ['idStatement' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCategory0()
    {
        return $this->hasOne(Category::className(), ['id' => 'idCategory']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeststatements()
    {
        return $this->hasMany(Teststatement::className(), ['idStatement' => 'id']);
    }

    /**
     * @inheritdoc
     * @return StatementQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StatementQuery(get_called_class());
    }
}
