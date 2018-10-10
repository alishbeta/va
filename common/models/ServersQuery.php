<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Servers]].
 *
 * @see Servers
 */
class ServersQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Servers[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Servers|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
