<?php

namespace backend\modules\api\models;

use Yii;

/**
 * This is the model class for table "userresponse".
 *
 * @property integer $id
 * @property integer $idQuestion
 * @property integer $idProfile
 * @property integer $idOpcionrespuesta
 * @property integer $answer
 *
 * @property Answeroption $idOpcionrespuesta0
 * @property Question $idQuestion0
 * @property Profile $idProfile0
 */
class Userresponse extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'userresponse';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idQuestion', 'idProfile', 'idOpcionrespuesta'], 'required'],
            [['idQuestion', 'idProfile', 'idOpcionrespuesta', 'answer'], 'integer'],
            [['idOpcionrespuesta'], 'exist', 'skipOnError' => true, 'targetClass' => Answeroption::className(), 'targetAttribute' => ['idOpcionrespuesta' => 'id']],
            [['idQuestion'], 'exist', 'skipOnError' => true, 'targetClass' => Question::className(), 'targetAttribute' => ['idQuestion' => 'id']],
            [['idProfile'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['idProfile' => 'user_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('yii', 'ID'),
            'idQuestion' => Yii::t('yii', 'Id Question'),
            'idProfile' => Yii::t('yii', 'Id Profile'),
            'idOpcionrespuesta' => Yii::t('yii', 'Id Opcionrespuesta'),
            'answer' => Yii::t('yii', '1:True 0:False'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdOpcionrespuesta0()
    {
        return $this->hasOne(Answeroption::className(), ['id' => 'idOpcionrespuesta']);
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
    public function getIdProfile0()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'idProfile']);
    }

    /**
     * @inheritdoc
     * @return UserresponseQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserresponseQuery(get_called_class());
    }
}
