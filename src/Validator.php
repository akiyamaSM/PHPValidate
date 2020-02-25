<?php


namespace Inani\PHPValidate;


class Validator
{
  protected $data = [];

  protected $rules = [];

  protected $isError = false;

  public function  __construct($data){
    $this->data = $data;
  }

  /**
   * Add a new Rule to check against
   *
   * @param Rule $rule
   * @return $this
   */
  public function addRule(Rule $rule)
  {
    $this->rules[$rule->getFieldName()] = $rule;

    return $this;
  }

  /**
   * Check if its valid
   *
   * @return bool
   */
  public function check()
  {
    foreach ($this->data as $field => $value){
      if($this->rules[$field]->validate($value) === false ){
        $this->isError = true;
      }
    }
    return !$this->isError;
  }

  /**
   * Get the errors or the error of the specified key
   *
   * @param null $key
   * @return array
   */
  public function getErrors($key = null)
  {
    if(!$this->isError){
      return [];
    }

    $errors = [];
    $keys = [$key];

    if(is_null($key)){
      $keys = array_keys($this->rules);
    }
    foreach ($keys as $key){
      $rule = $this->rules[$key];
      foreach ($rule->getConstraints() as $constraint){
        if($constraint->hasError()){
          $errors[$key][strtolower($this->get_class_name(get_class($constraint)))] = $constraint->getError();
        }
      }
    }
    return $errors;
  }

  /**
   * Get the class name only
   *
   * @param $constraint
   * @return false|int|string
   */
  private function get_class_name($constraint)
  {
    if ($pos = strrpos($constraint, '\\')) return substr($constraint, $pos + 1);
    return $pos;
  }
}

