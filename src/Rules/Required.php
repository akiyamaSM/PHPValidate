<?php
namespace Inani\PHPValidate\Rules;

class Required extends AbstractRule implements Checkable
{

  /**
   * Check if is a number
   *
   * @param null $value
   * @return bool
   */
    public function isValid($value = null)
    {
        if ($value) {
            return true;
        }

        $this->errorFound();

        return false;
    }

    public function getError()
    {
        return "This field must be required";
    }
}
