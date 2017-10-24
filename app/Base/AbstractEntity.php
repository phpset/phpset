<?php
declare(strict_types = 1);

namespace App\Base;

abstract class AbstractEntity implements \JsonSerializable
{
//    public function __construct()
//    {
//        foreach (get_defined_vars() as $key => $value) {
//            $this->{$key} = $value;
//        }
//    }

    public static function fromStdClass(\stdClass $object)
    {
        @$instance = new static();
        $vars = get_object_vars($object);
        foreach ($vars as $key => $value) {
            $instance->{$key} = $value;
        }
        return $instance;
    }

    public static function fromJson($json)
    {
        return static::fromStdClass(json_decode($json));
    }


    public function toArray()
    {
        return get_object_vars($this);
    }

    public function toJson()
    {
        return json_encode($this);
    }

    public function jsonSerialize()
    {
        $var = get_object_vars($this);
        foreach ($var as &$value) {
            if (is_object($value) && $value instanceof \JsonSerializable) {
                $value = $value->jsonSerialize();
            }
        }
        return $var;
    }
}
