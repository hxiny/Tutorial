<?php
/**
 * Created by PhpStorm.
 * User: levi
 * Date: 2016/11/19
 * Time: 19:55
 */

namespace app\models;


class RedisClient
{
    private $_linkServer = array(
        'master' => null,
        'slave' => array()
    );

    public function connect($config=array('host'=>'127.0.0.1', 'port'=>6379))
    {
        if (!isset($config['port'])) {
            $config['port'] = 6379;
        }

        $this->_linkServer['master'] = new \Redis();

        $ret = $this->_linkServer['master']->pconnect($config['host'], $config['port']);//长连接

        return $ret;
    }

    public function getRedis()
    {
        return $this->_linkServer['master'];
    }

    public function close()
    {
        $this->_linkServer['master']->close();
        return true;
    }

    public function set($key, $value, $expire=0)
    {
        if ($expire == 0) {
            $ret = $this->getRedis()->set($key, $value);
        } else {
            $ret = $this->getRedis()->set($key, $expire, $value);
        }

        return $ret;
    }

    public function get($key)
    {
        $func = is_array($key)?'mGet':'get';

        return $this->getRedis()->{$func}($key);
    }

    public function setnx($key, $value)
    {
        return $this->getRedis()->setnx($key, $value);
    }

    /**
     * @param $key string or array
     * @return mixed
     */
    public function delete($key)
    {
        return $this->getRedis()->delete($key);
    }

    public function incr($key, $default=1)
    {
        if ($default == 1) {
            return $this->getRedis()->incr($key);
        } else {
            return $this->getRedis()->incrBy($key, $default);
        }
    }

    public function decr($key, $default=1)
    {
        if ($default == 1) {
            return $this->getRedis()->decr($key);
        } else {
            return $this->getRedis()->decrBy($key, $default);
        }
    }

    public function clear()
    {
        return $this->getRedis()->flushDB();
    }

    public function lpush($key, $value)
    {
        return $this->getRedis()->lpush($key, $value);
    }

    public function lpop($key)
    {
        return $this->getRedis()->lpop($key);
    }

    public function lrange($key, $start, $end)
    {
        return $this->getRedis()->lrange($key, $start, $end);
    }

    public function hset($name, $key, $value)
    {
        if (is_array($value)) {
            return $this->getRedis()->hset($name, $key, serialize($value));
        }

        return $this->getRedis()->hset($name, $key, $value);
    }

    public function hget($name, $key = null, $serialize = true)
    {
        if ($key) {
            $row = $this->getRedis()->hget($name, $key);

            if ($row && $serialize) {
                unserialize($row);
            }

            return $row;
        }

        return $this->getRedis()->hgetAll($name);
    }

    public function hdel($name, $key = null)
    {
        if ($key) {
            return $this->getRedis()->hdel($name, $key);
        }

        return $this->getRedis()->hdel($name);
    }
}