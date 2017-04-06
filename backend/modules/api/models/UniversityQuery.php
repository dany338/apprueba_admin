<?php

namespace backend\modules\api\models;

/**
 * This is the ActiveQuery class for [[University]].
 *
 * @see University
 */
class UniversityQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return University[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return University|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
