<?php 

require 'Person.php';

class MagicTest extends \PHPUnit_Framework_TestCase
{
  function setUp()
  {
    $this->person = new Person;
  }
  
  public function testNameGetter()
  {
      $this->assertEquals("tester", $this->person->getName());
  }
  
  public function testHasMethod()
  {
    $this->assertTrue($this->person->hasName());
    $this->assertFalse($this->person->hasFamily());
  }
  
  public function testIsMethod()
  {
    $this->assertTrue($this->person->isCool());
    $this->person->setIsCool(false);
    $this->assertFalse($this->person->isCool());
    
    $this->assertFalse($this->person->isFat());
  }

  public function testNameSetter()
  {
    $this->person->setName(1000);
    $this->assertEquals(1000, $this->person->getName());
    
    $this->person->setName('T3sting Things');
    $this->assertEquals('T3sting Things', $this->person->get('name'));
    
    $this->assertNull($this->person->get("nonexistent"));
    
    $this->assertEquals('fallback', $this->person->get('nonexistent', 'fallback'));
  }
}