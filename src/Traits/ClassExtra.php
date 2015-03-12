<?php
/**
 * Created by PhpStorm.
 * User: darkilliant
 * Date: 3/12/15
 * Time: 2:04 PM
 */

namespace Traits;


trait ClassExtra {

    public function printEventReceive()
    {
        echo "event receiver on ".__CLASS__." -> ".__METHOD__.PHP_EOL;
    }
}