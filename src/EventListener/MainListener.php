<?php
/**
 * Created by PhpStorm.
 * User: darkilliant
 * Date: 3/12/15
 * Time: 1:42 PM
 */
namespace EventListener;

use Event\AppEvent;
use Traits\ClassExtra;

class MainListener {

    use ClassExtra;

    public function onMain(AppEvent $event)
    {
        $this->printEventReceive();

        $event->addData(__CLASS__." -> ".__METHOD__);
    }
}