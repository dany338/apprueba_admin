<?php

namespace backend\modules\api\models;

/**
 * This is the ActiveQuery class for [[Answeroption]].
 *
 * @see Answeroption
 */
class AnsweroptionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Answeroption[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Answeroption|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
