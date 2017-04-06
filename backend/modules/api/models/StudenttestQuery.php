<?php

namespace backend\modules\api\models;

/**
 * This is the ActiveQuery class for [[Studenttest]].
 *
 * @see Studenttest
 */
class StudenttestQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Studenttest[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Studenttest|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
