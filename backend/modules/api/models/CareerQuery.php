<?php

namespace backend\modules\api\models;

/**
 * This is the ActiveQuery class for [[Career]].
 *
 * @see Career
 */
class CareerQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Career[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Career|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
