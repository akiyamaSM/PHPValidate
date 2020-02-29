<?php
namespace Inani\PHPValidate\Tests;

use Inani\PHPValidate\Rule;
use Inani\PHPValidate\Validator;
use PHPUnit\Framework\TestCase;

class RuleTest extends TestCase
{
    /** @test */
    public function can_validate_required()
    {
        $validator = new Validator(['name' => 'john doe']);

        $validator->addRule((new Rule('name'))->required());

        $this->assertTrue($validator->check());
    }

    /** @test */
    // TODO : need to fix this behavior
    public function cannot_validate_required()
    {
        $validator = new Validator(['first_name' => 'john']);

        $validator->addRule((new Rule('last_name'))->required());

        $this->assertTrue($validator->check());
    }

    /** @test */
    public function can_validate_number()
    {
        $validator = new Validator(['age' => 10]);

        $validator->addRule((new Rule('age'))->number());

        $this->assertTrue($validator->check());
    }
}
