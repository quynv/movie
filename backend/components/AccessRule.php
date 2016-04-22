<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Quy
 * Date: 4/22/2016
 * Time: 1:05 AM
 */

namespace backend\components;


class AccessRule extends \yii\filters\AccessRule
{
    /**
     * @inheritdoc
     */
    protected function matchRole($user)
    {
        if (empty($this->roles)) {
            return true;
        }
        foreach ($this->roles as $role) {
            if ($role == '?') {
                if ($user->getIsGuest()) {
                    return true;
                }
            } elseif (!$user->getIsGuest() && $role == $user->identity->role) {
                return true;
            }
        }

        return false;
    }
}