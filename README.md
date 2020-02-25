# Welcome to StackEdit!

You have some input data to validate but you don't want to grab the huge libraries to validate them?
Well here is the solution, PHPValidate is a very light libraries that allows you to validate simple data and enables you to create custom constraint at any time! Come on give it a try!


# Installation

# Usage

 1. Feed the **Validator** with the array data to verifies

        $validator = new Validator([  'name' => 'Inani El Houssain']);
2. Build your Rules

        // Only if required and without length greater or equal than 10 characteres
        $validator->addRule(( new Rule('name'))->required()->min(10));
3. Check the rules

        $bool = $validator->check();

4. Get the errors list

        // get the errors of the name field, all the fields if not specified
        $validator->getErrors('name');

# Available rules

|rule |parameters|

# Custom Constraints


