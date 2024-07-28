<?php

namespace App\Helpers;

use App\Models\SystemParameter;

class CstrikeWebAdmin 
{
    public static function getSystemParameterValueByKey($parameter_key) 
    {
        return SystemParameter::where('key', $parameter_key)->firstOrFail()->value;
    }
}