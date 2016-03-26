<?php
namespace Access;

/**
* Magic
*
* Allows you to call getPropertyName and setPropertyName on a class
* even if such methods are not defined in the class
*/
abstract class Magic
{

  function __call($name, $args)
  {
    switch(substr($name, 0, 3)) {
      case 'get':
        $getOrSet = 'get';
        break;

      case 'set':
        $getOrSet = 'set';
        break;

      case 'has':
        $getOrSet = 'has';
        break;

      default:
        if(substr($name, 0, 2) == "is") {
          $getOrSet = 'is';
        }else {
          $getOrSet = null;
        }
        break;
    }

    if($getOrSet) {

      $rawPropertyName = substr($name, strlen($getOrSet));
      $propertyName = strtolower($rawPropertyName[0]) . substr($rawPropertyName, 1, strlen($rawPropertyName));

      if($getOrSet == "set") {

        return $this->set($propertyName, $args[0]);

      }elseif ($getOrSet == "has") {

        return isset($this->$propertyName) && !empty($this->$propertyName);
        
      }else {

        if(isset($this->$propertyName)) {
          return $this->$propertyName;
        }else {
          return $this->{$getOrSet.$rawPropertyName};
        }

      }

    }else {
      throw new \BadMethodCallException("Unknown method '$name'", 1);
    }
  }
  
  public function set($key, $value)
  {
    $this->$key = $value;

    // convert to camelCase
    $funcName = 'on' . strtoupper($key[0]) . substr($key, 1) . 'Set';
    
    // Call onPropertyNameSet if it is defined
    if(method_exists($this, $funcName)) {
      $this->$key = call_user_func([$this, $funcName], $value);
    }
    
    return $this;
  }
  
  public function get($key, $fallback = null)
  {
    if(isset($this->$key)) {
      return $this->$key;
    }
    
    return $fallback;
  }
  
}