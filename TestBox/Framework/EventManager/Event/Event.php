<?php
namespace TestBox\Framework\EventManager\Event;

class Event extends EventAbstract
{
    /**
     * Constructor
     *
     * @param string $identifier
     */
    public function __construct($identifier)
    {
        $this->identifier = $identifier;
    }
}