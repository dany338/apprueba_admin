<?php

namespace backend\modules\api\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 *
 * @property Statement[] $statements
 */
class Category extends \yii\db\ActiveRecord
{
    const SCENARIO_CREATE = 'create'; 
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code','name'], 'required'],
            [['code'], 'string', 'max' => 45],
            [['name'], 'string', 'max' => 255],
        ];
    }

    public function scenarios() 
    {
        $scenarios = parent::scenarios();
        $scenarios['create'] = ['name','code'];
        return $scenarios;
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatements()
    {
        return $this->hasMany(Statement::className(), ['idCategory' => 'id']);
    }

    /**
     * @inheritdoc
     * @return CategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CategoryQuery(get_called_class());
    }
}
