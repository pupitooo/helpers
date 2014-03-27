<?php

namespace Pto\Helpers;

class Helper
{

    final public function __construct()
    {
        throw new \RuntimeException('This class ' . get_class($this) . ' cannot instance of object.');
    }

}
