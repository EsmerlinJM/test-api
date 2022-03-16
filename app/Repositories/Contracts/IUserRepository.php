<?php

namespace App\Repositories\Contracts;

use App\Repositories\Core\IRepository;

interface IUserRepository extends IRepository {
    public function getContactsInformationPaginated($inputs);
    public function createMany($input, $model);
}