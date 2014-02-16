<?php
namespace TestBox\Framework\Environment\Element;

class SessionManager
{
    public function register($key,$value)
    {
        $_SESSION[$key] = $value;
    }
}