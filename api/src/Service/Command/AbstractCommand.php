<?php 
namespace App\Service\Command;

use ReflectionClass;

abstract class AbstractCommand
{
    /**
     *
     * @var array
     */
    private $_data;
    
    /**
     *
     * @param array $data
     */
    public function __construct($data = null)
    {
        if(isset($data)){
            $this->setValues($data);
        }
    }
    
    /**
     *
     * @param string $key
     * @param mixed $value
     */
    public function setValue(string $key, $value)
    {
        $this->_data[$key] = $value;
        $this->$key = $value;
    }
    
    /**
     * @param array $data
     */
    public function setValues($data)
    {
        foreach ($data as $key => $value ) {
            $this->setValue($key, $value);
        }
    }
    
    /**
     *
     * @param string $key
     * @return mixed
     */
    public function getValue(string $key)
    {
        return $this->_data[$key];
    }
    
    /**
     *
     * @return array
     */
    public function getValues()
    {
        return $this->_data;
    }

    /**
     *
     * @return array
     */
    public function toArray() {
        return get_object_vars($this);
    }
}