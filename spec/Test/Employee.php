<?php
namespace Test;

/**
 * Class Employee
 * @package Test
 */
class Employee
{
    /**
     * @var string Employee name
     */
    public $name = '';
    /**
     * @var array Employee data
     */
    private $data = [];

    public function __construct($name, array $data = [])
    {
        $this->name = $name;
        $this->data = $data;
    }
}