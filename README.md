# Magic methods
Getters and setters for any class, with onSet listeners

## Installation

Magic can be installed using composer. Run this command:

```
composer require hrn4n/magic
```

## Usage 
To use it simply create a class that extends the Access\\Magic class:

```php
<?php 
class Person extends Access\Magic
{
  protected $name;
}

```

And that's it, you can start using getters and setters:

```php
<?php
$me = new Person;

$me->setName("Hernan");

$me->get("name"); # returns "Hernan"
$me->getName(); # also returns "Hernan"
```

### onSet listeners

Say we add a onNameSet to our Person class:

```php

<?php 
class Person extends Access\Magic
{
  protected $name;
  
  public function onNameSet($name) {
    # convert name to uppercase before setting 
    return strtoupper($name);
  }
}
```

Then we run the following code:

```php
<?php 
$me = new Person;
$me->set("name", "hernan"); # alternative way of setting properties

$me->getName(); # returns "HERNAN"
```
