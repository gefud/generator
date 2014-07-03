<?php
namespace Test;

/**
 * Class Employee
 * @package Test
 */
class Employee
{
    /**
     * @var string
     */
    public $name = '';
    /**
     * @var array
     */
    private $data = [];

    public function __construct($name, array $data = [])
    {
        $this->name = $name;
        $this->data = $data;
    }
}