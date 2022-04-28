<?php

declare(strict_types=1);

namespace Lisettes\Account\Controller;

use App\Model\User;

use Lisettes\Account\Request\Account;
use Lisettes\Utils\Abstracts\AbstractController;
use Lisettes\Utils\Exception\Response\ErrorResponse;
use Lisettes\Utils\Exception\Response\SuccessResponse;

/**
 * AccountController.
 */
class AccountController extends AbstractController
{
    /**
     * 获取账户信息
     */
    public function getInfo()
    {
        /** @var User $user */
        $user = $this->request->getAttribute('user', 0);
        throw new SuccessResponse($user->getInfo());
    }

    /**
     * 修改账户信息
     */
    public function updateInfo()
    {
        $request = di(Account::class);
        $request->scene('update-info')->validateResolved();
        $data = $request->validated();

        /** @var User $user */
        $user = $this->request->getAttribute('user', 0);
        foreach (array_intersect(array_keys($data), array_keys($request->getScene()['update-info'])) as $key) {
            $user->{$key} = trim($data[$key]);
        }
        $user->save();

        throw new SuccessResponse($user->getInfo());
    }

    /**
     * 修改登录密码
     */
    public function updatePassword()
    {
        $request = di(Account::class);
        $request->scene('update-password')->validateResolved();
        $data = $request->validated();

        /** @var User $user */
        $user = $this->request->getAttribute('user', 0);
        if (!password_verify($data['old_password'], $user->password)) {
            throw new ErrorResponse(trans('account.messages.old-password-error'));
        }
        $user->password = trim($data['password']);
        $user->save();

        throw new SuccessResponse([]);
    }

    /**
     * 修改交易密码
     */
    public function updateTradePassword()
    {
        $request = di(Account::class);
        $request->scene('update-password')->validateResolved();
        $data = $request->validated();

        /** @var User $user */
        $user = $this->request->getAttribute('user', 0);
        if (!password_verify($data['old_password'], $user->trade_password)) {
            throw new ErrorResponse(trans('account.messages.old-trade-password-error'));
        }
        $user->trade_password = trim($data['password']);
        $user->save();

        throw new SuccessResponse([]);
    }
}
