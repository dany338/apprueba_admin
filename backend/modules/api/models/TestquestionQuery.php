<?php

namespace backend\modules\api\models;

/**
 * This is the ActiveQuery class for [[Testquestion]].
 *
 * @see Testquestion
 */
class TestquestionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Testquestion[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Testquestion|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
