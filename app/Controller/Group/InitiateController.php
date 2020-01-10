<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

namespace App\Controller\Group;

use App\Controller\AbstractController;


class InitiateController extends AbstractController
{
    public function index()
    {
        $method = $this->request->getMethod();

        return [
            'method'  => $method,
            'message' => __file__,
            'result'  => __CLASS__
        ];
    }
}
