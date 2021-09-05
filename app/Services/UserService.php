<?php

namespace App\Services;

use App\Contracts\Services\UserService as UserServiceInterface;
use App\Models\User;

/**
 * Class BaseService.
 *
 * @package namespace App\Services;
 */
class UserService extends BaseService implements UserServiceInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}
