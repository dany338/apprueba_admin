<?php

namespace backend\modules\api\models;

/**
 * This is the ActiveQuery class for [[Usertype]].
 *
 * @see Usertype
 */
class UsertypeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Usertype[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Usertype|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
