<?php
/**
 * Created by PhpStorm.
 * User: darkilliant
 * Date: 3/12/15
 * Time: 1:47 PM
 */
namespace Event;

use Symfony\Component\EventDispatcher\Event;

final class AppEvent extends Event {
    const MAIN = "main";

    private $data = array();

    public function __construct()
    {
    }

    public function addData($dataItem)
    {
        $this->data[] = $dataItem;
    }

    public function getData()
    {
        return $this->data;
    }
}