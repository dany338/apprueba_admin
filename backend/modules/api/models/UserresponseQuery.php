<?php

namespace backend\modules\api\models;

/**
 * This is the ActiveQuery class for [[Userresponse]].
 *
 * @see Userresponse
 */
class UserresponseQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Userresponse[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Userresponse|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
