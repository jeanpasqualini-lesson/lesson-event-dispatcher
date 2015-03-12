<?php
/**
 * Created by PhpStorm.
 * User: darkilliant
 * Date: 3/12/15
 * Time: 1:27 PM
 */

namespace Test;


use Event\AppEvent;
use EventListener\MainListener;
use EventListener\MainSubscriber;
use Interfaces\TestInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;

class MainTest implements TestInterface {
    public function runTest()
    {
        $dispatcher = new EventDispatcher();

        $event = new AppEvent();

        $dispatcher->addSubscriber(new MainSubscriber());

        $dispatcher->dispatch(AppEvent::MAIN, $event);

        echo "data returned by event : ".PHP_EOL.print_r($event->getData(), true).PHP_EOL;
    }
}