<?php
namespace xtratio\Onpbx;

require __DIR__ . '/Util/Psr4Autoloader.php';

class Autoloader 
{
    public static function Register(){
        // instantiate the loader
        $loader = new Util\Psr4Autoloader();
        // register the autoloader
        $loader->register();
        // register the base directories for the namespace prefix
        $loader->addNamespace('xtratio\Onpbx', __DIR__);
    }
}
Autoloader::Register();

