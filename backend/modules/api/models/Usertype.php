<?php

namespace backend\modules\api\models;

use Yii;

/**
 * This is the model class for table "usertype".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Profile[] $profiles
 */
class Usertype extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usertype';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('yii', 'ID'),
            'name' => Yii::t('yii', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles()
    {
        return $this->hasMany(Profile::className(), ['idTipo' => 'id']);
    }

    /**
     * @inheritdoc
     * @return UsertypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsertypeQuery(get_called_class());
    }
}
