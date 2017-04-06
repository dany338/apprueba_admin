<?php

namespace backend\modules\api\models;

use Yii;

/**
 * This is the model class for table "picture".
 *
 * @property integer $id
 * @property integer $idStatement
 * @property integer $idQuestion
 * @property string $path
 * @property string $type
 * @property integer $size
 * @property string $name
 * @property integer $order
 * @property string $position
 *
 * @property Statement $idStatement0
 * @property Question $idQuestion0
 */
class Picture extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'picture';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idStatement', 'idQuestion', 'size', 'order'], 'integer'],
            [['path', 'type', 'size', 'name', 'order', 'position'], 'required'],
            [['path', 'type'], 'string', 'max' => 45],
            [['name'], 'string', 'max' => 255],
            [['position'], 'string', 'max' => 10],
            [['idStatement'], 'exist', 'skipOnError' => true, 'targetClass' => Statement::className(), 'targetAttribute' => ['idStatement' => 'id']],
            [['idQuestion'], 'exist', 'skipOnError' => true, 'targetClass' => Question::className(), 'targetAttribute' => ['idQuestion' => 'id']],
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
            'idQuestion' => Yii::t('yii', 'Id Question'),
            'path' => Yii::t('yii', 'Path'),
            'type' => Yii::t('yii', 'Type'),
            'size' => Yii::t('yii', 'Size'),
            'name' => Yii::t('yii', 'Name'),
            'order' => Yii::t('yii', 'Order'),
            'position' => Yii::t('yii', 'Position'),
        ];
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
    public function getIdQuestion0()
    {
        return $this->hasOne(Question::className(), ['id' => 'idQuestion']);
    }

    /**
     * @inheritdoc
     * @return PictureQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PictureQuery(get_called_class());
    }
}
