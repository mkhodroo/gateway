<?php 
namespace App\Traits;

use App\Gateway;
use Config;

trait GatewayConfig
{
    public function setGateways()
    {
        $gateways = Gateway::get();
        
        foreach($gateways as $gateway)
        {
            $info = json_decode($gateway->info);
            $propertyName = \get_object_vars($info);
            $propertyName = array_keys($propertyName);
            $l = count($propertyName);

            for($i=0; $i<$l; $i++)
            {
                $propertyNamei = $propertyName[$i];
                $name = $gateway->name;
                $set = $info->$propertyNamei;
                Config::set("gateway.$name.$propertyNamei", "$set");
            }
        }
    }
}