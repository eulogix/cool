<?php

/*
 * This file is part of the Eulogix\Cool package.
 *
 * (c) Eulogix <http://www.eulogix.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
*/

namespace Eulogix\Cool\Bundle\CoreBundle\Model\Core;

use Eulogix\Cool\Bundle\CoreBundle\Model\Core\om\BaseAccount;


use Eulogix\Cool\Lib\Cool;

class Account extends BaseAccount
{
    const DEFAULT_PASSWORD_EXPIRATION_DAYS = 90;

    public function getSetting($settingName)
    {
        $cdb = Cool::getInstance()->getCoreSchema()->fetch("SELECT value FROM account_setting_prioritized WHERE account_id=:user_id AND name=:name AND valid=TRUE",array(':user_id'=>$this->getAccountId(), ':name'=>$settingName));
        return $cdb;
    }

    /**
     * @param string $settingName
     * @param string $value
     * @return self
     */
    public function setSetting($settingName, $value)
    {
        if($value === null)
            $this->removeSetting($settingName);
        else {
            $currentSetting = AccountSettingQuery::create()->filterByAccount($this)->filterByName($settingName)->findOne();
            if(!$currentSetting) {
                $currentSetting = new AccountSetting();
                $currentSetting->setAccount($this)->setName($settingName);
            }
            $currentSetting->setValue($value)->save();
        }
        return $this;
    }

    /**
     * @param string $settingName
     */
    public function removeSetting($settingName) {
        Cool::getInstance()->getCoreSchema()->query( "DELETE FROM account_setting WHERE account_id=:user_id AND name=:name", [
            ':user_id'=>$this->getAccountId(),
            ':name'=>$settingName
        ]);
    }

    public function toArraySafe() {
        $ret = parent::toArray(\BasePeer::TYPE_FIELDNAME);
        unset($ret['password']);
        unset($ret['hashed_password']);
        return $ret;
    }

    /**
     * @return string
     */
    public function getHumanDescription() {
        return $this->getFirstName().' '.$this->getLastName();
    }

    /**
     * @return null|\Eulogix\Cool\Lib\File\FileProxyInterface
     */
    public function getAvatar() {
        $avatars = $this->getFileRepository()->getChildrenOf('cat_AVATAR', false);
        if($avatars->count() == 1)
            return $avatars->fetch()[0];
        return null;
    }

    /**
     * @param AccountGroup $group
     * @return bool
     */
    public function isInGroup(AccountGroup $group) {
        return AccountGroupRefQuery::create()->filterByAccountGroup($group)->filterByAccount($this)->count() > 0;
    }

    /**
     * @return int[]
     */
    public function getGroupIds() {
        return $this->getCoolDatabase()->fetchArrayWithNumericKeys("SELECT account_group_id FROM account_group_ref WHERE account_id = :id", [':id' => $this->getAccountId()]);
    }

    /**
     * @return bool
     */
	public function isPasswordExpired()
    {
        $expirationDays = Cool::getInstance()->getContainer()->getParameter('cool.max_passwords_lifetime_days') ?? self::DEFAULT_PASSWORD_EXPIRATION_DAYS;
        return $this->getPasswordAgeInDays() >= $expirationDays;
    }

    /**
     * @return int
     */
    public function getPasswordAgeInDays() {
        if($this->getLastPasswordUpdate()) {
            $interval = date_diff($this->getLastPasswordUpdate(), new \DateTime());
            return $interval->format('%a');
        }
        return 0;
    }

    /**
     * @inheritdoc
     */
    public function setPassword($v)
    {
        $this->setHashedPassword(md5($v));
        return parent::setPassword($v);
    }
}