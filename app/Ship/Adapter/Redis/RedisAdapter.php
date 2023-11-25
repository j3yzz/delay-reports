<?php

namespace App\Ship\Adapter\Redis;

use Illuminate\Support\Facades\Redis;

class RedisAdapter
{
    public function pushToQueue(string $queueName, $data)
    {
        return Redis::connection()->rpush($queueName, json_encode($data));
    }

    public function isMember(string $setName, string $member)
    {
        return Redis::connection()->sismember($setName, $member);
    }

    public function sadd(string $setName, $member)
    {
        return Redis::connection()->sadd($setName, $member);
    }

    public function rpush(string $listName, $data)
    {
        return Redis::connection()->rpush($listName, $data);
    }

    public function lindex(string $listName, int $index)
    {
        return Redis::connection()->lindex($listName, $index);
    }

    public function lpop(string $listName)
    {
        return Redis::connection()->lpop($listName);
    }
}
