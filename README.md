# Welcome to PHPValidate!

You have some input data to validate but you don't want to grab the huge libraries to validate them?
Well here is the solution, PHPValidate is a very light libraries that allows you to validate simple data and enables you to create custom constraint at any time! Come on give it a try!


# Installation
```bash
composer require inani/phpvalidate 
```
# Usage

Feed the **Validator** with the array data to verifies
```php
$validator = new Validator([  'name' => 'Inani El Houssain']);
```
Build your Rules
```php
// Only if required and without length greater or equal than 10 characters
$validator->addRule(( new Rule('name'))->required()->min(10));
```
Check the rules
```php
$bool = $validator->check();
```
Get the errors list
```php
// get the errors of the name field, all the fields if not specified
$validator->getErrors('name');
```
# Available rules


| rule | README |
| ------ | ------ |
| required | Field not empty |
| min | The minimum characters |
| max | The maximum number of characters|
| number | the input should be a numeric value |
# Custom Constraints
Every custom rule should extends the **CustomConstraint** Class and implements the two methods, for instance creating a rule that validates an email field:
```php

<?php
use Inani\PHPValidate\CustomConstraint;

class ShouldBeAnEmail extends CustomConstraint
{
  /**
   * Check if the field is Required
   *
   * @param null $value
   * @return bool
   */
  public function isValid($value = null)
  {
    if(!filter_var($value, FILTER_VALIDATE_EMAIL)){

      $this->errorFound();

      return false;
    }

    return true;
  }

  public function getError()
  {
    return "This is not a valid email";
  }
}
```
And its usage is as simple as injecting the Rule in the rules array like this :
```php
$validator->addRule(( new Rule('email'))->required()->inject(new ShouldBeAnEmail));
```
