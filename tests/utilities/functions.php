<?php

/**
 * Create an instance of a model.
 *
 * @param $class
 * @param array $attributes
 * @param null $times
 *
 * @return mixed
 */
function create($class, $attributes = [], $times = null)
{
    return factory($class, $times)->create($attributes);
}

/**
 * Make an instance of a model.
 *
 * @param $class
 * @param array $attributes
 * @param null $times
 *
 * @return mixed
 */
function make($class, $attributes = [], $times = null)
{
    return factory($class, $times)->make($attributes);
}