<?php

namespace SocialAuther;

use SocialAuther\Adapter\AdapterInterface;

class SocialAuther
{
    /**
     * Adapter manager
     *
     * @var AdapterInterface
     */
    protected  $adapter = null;

    /**
     * Constructor.
     *
     * @param AdapterInterface $adapter
     * @throws Exception\InvalidArgumentException
     */
    public function __construct($adapter)
    {
        if ($adapter instanceof AdapterInterface) {
            $this->adapter = $adapter;
        } else {
            throw new Exception\InvalidArgumentException(
                'SocialAuther only expects instance of the type' .
                'SocialAuther\Adapter\AdapterInterface.'
            );
        }
    }

    /**
     * Call method authenticate() of adater class
     *
     * @return bool
     */
    public function authenticate()
    {
        return $this->adapter->authenticate();
    }

    /**
     *Способ вызова этого класса или методы класса адаптера
     *
     * @param $method
     * @param $params
     * @return mixed
     */
    public function __call($method, $params)
    {
        if (method_exists($this, $method)) {
            return $this->$method($params);
        }

        if (method_exists($this->adapter, $method)) {
            return $this->adapter->$method();
        }
    }
}