<?php

namespace Iplox;
use Iplox\Config as Cfg;

class Bundle {
    
    //Return a configuration class, if exists under the conventional configuration directories
    public static function get($bdl)
    {
        $gral = Cfg::get('General');
        
        if(! isset($bdl))
        {
            return null;
        }
        else if(class_exists($class = Cfg::getAppNamespace()."\\".$gral::BUNDLES_DIR."\\".$bdl."Bundle"))
        {
            return $class;                
        }
        else if(class_exists($class = Cfg::getAppNamespace()."\\".$gral::BUNDLES_DIR."\\".Cfg::getEnv()."\\$bdl"."Bundle"))
        {
            return $class;                
        }
        else
        {
            return "Iplox\\Bundles\\".$bdl."Bundle"; 
        }
    }
    
}