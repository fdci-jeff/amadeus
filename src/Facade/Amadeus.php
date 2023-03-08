<?php 

namespace Jeff\Amadeus\Facade;

use Illuminate\Support\Facades\Facade;

class Amadeus extends Facade
{
    protected static function getFacadeAccessor() { return 'amadeus'; }
}