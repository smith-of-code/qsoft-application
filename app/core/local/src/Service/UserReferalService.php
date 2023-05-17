<?php

namespace QSoft\Service;

use Bitrix\Main\Type\DateTime;
use Bitrix\Sale\Internals\DiscountTable;
use QSoft\Entity\User;

class UserReferalService
{
    private User $user;

    private $pass;
    private $method;

    /**
     * UserGroupsService constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->pass = 'e5a562cabdb04d37405f560cef12cab6320856e6';
        $this->method = 'aria128';
    }

    public function getReferalId(): ?string
    {
        if (!$this->user->isAuthorized){
            return '';
        }

        return
            urlencode(
            openssl_encrypt($this->user->id, $this->method, $this->pass)
        )
;
    }

    public function getUserIdByRefRequest()
    {
//        return bin2hex(openssl_random_pseudo_bytes(20, $cstrong));
        return openssl_decrypt(str_replace(' ','+',urldecode($_REQUEST['refid'])), $this->method, $this->pass);
    }
}