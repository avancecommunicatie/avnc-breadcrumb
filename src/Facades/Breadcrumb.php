<?php namespace avancecommunicatie\Breadcrumb\Facades;

use Illuminate\Support\Facades\Facade;
use avancecommunicatie\Breadcrumb\Breadcrumb as AvncBreadcrumb;

class Breadcrumb extends Facade {

    protected static function getFacadeAccessor() { return AvncBreadcrumb::class; }

}
