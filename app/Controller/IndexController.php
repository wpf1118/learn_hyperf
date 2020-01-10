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

namespace App\Controller;

use App\Model\Test;
use Hyperf\Redis\Redis;
use Hyperf\Utils\Exception\ParallelExecutionException;
use Hyperf\Utils\Coroutine;
use Hyperf\Utils\Parallel;
use Hyperf\Utils\ApplicationContext;


class IndexController extends AbstractController
{
    public function index()
    {

        $container = ApplicationContext::getContainer();

        $redis = $container->get(Redis::class);

        $result = $redis->keys('*');

        $user = Test::query()->create(['name' => 'Hyperf']);

        $user   = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();

        $parallel = new Parallel();
        $parallel->add(function () {
            sleep(1);
            return Coroutine::id();
        });
        $parallel->add(function () {
            sleep(1);
            return Coroutine::id();
        });

        try {
            // $results 结果为 [1, 2]
            $results = $parallel->wait();
        } catch (ParallelExecutionException $e) {
            // $e->getResults() 获取协程中的返回值。
            // $e->getThrowables() 获取协程中出现的异常。
        }

        return [
            'method'  => $method,
            'message' => "Hello {$user}.",
            'result'  => $results
        ];
    }
}
