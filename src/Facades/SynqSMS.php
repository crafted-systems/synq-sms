<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 12/13/17
 * Time: 6:39 AM
 */

namespace CraftedSystems\Synq\Facades;

use Illuminate\Support\Facades\Facade;

class SynqSMS extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'synq-sms';
    }
}