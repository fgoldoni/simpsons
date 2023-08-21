<?php

/**
 * Created by PhpStorm.
 * User: goldoni
 * Date: 24.09.18
 * Time: 22:13.
 */

namespace App\Repositories\Criteria;

/**
 * interface CriteriaInterface.
 */
interface CriteriaInterface
{
    /**
     * @return mixed
     */
    public function withCriteria(mixed ...$criteria);
}
