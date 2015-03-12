<?php
/**
 * Created by PhpStorm.
 * User: darkilliant
 * Date: 3/12/15
 * Time: 1:54 PM
 */

namespace EventListener;


use Event\AppEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Traits\ClassExtra;

class MainSubscriber implements EventSubscriberInterface {

    use ClassExtra;
    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * array('eventName' => 'methodName')
     *  * array('eventName' => array('methodName', $priority))
     *  * array('eventName' => array(array('methodName1', $priority), array('methodName2'))
     *
     * @return array The event names to listen to
     *
     * @api
     */
    public static function getSubscribedEvents()
    {
        return array(
            AppEvent::MAIN => array(
                array("addEventListener", 10),
                array("onMain", 8),
                array("notify", 5),
                array("end", 1),
                array("ignored", 0)
            )
        );
    }

    public function end(AppEvent $event, $name, EventDispatcherInterface $dispatcher)
    {
        $this->printEventReceive();

        $event->addData(__CLASS__." -> ".__METHOD__);

        $event->addData("stop propogation ignore last listener");

        $listeners = $dispatcher->getListeners($name);

        foreach($listeners as $listener)
        {
            $event->addData("listener registered : ".get_class($listener[0])." -> ".$listener[1]);
        }

        $event->stopPropagation();
    }

    public function ignored(AppEvent $event, $name, EventDispatcherInterface $dispatcher)
    {
        $event->addData("this ignored");
    }

    public function notify(AppEvent $event, $name, EventDispatcherInterface $dispatcher)
    {
        $dispatcher->removeListener($name, array($this, "notify"));

        $event->addData(__CLASS__." -> ".__METHOD__);

        $event->addData("Redispatch same event with event listener added");

        $dispatcher->dispatch($name, $event);
    }

    public function addEventListener(AppEvent $event, $name, EventDispatcherInterface $dispatcher)
    {
        $this->printEventReceive();

        $event->addData(__CLASS__." -> ".__METHOD__);

        $dispatcher->addListener($name, array(
            new MainListener(),
            "onMain"
        ));
    }

    public function onMain(AppEvent $event)
    {
        $this->printEventReceive();

        $event->addData(__CLASS__." -> ".__METHOD__);
    }
}