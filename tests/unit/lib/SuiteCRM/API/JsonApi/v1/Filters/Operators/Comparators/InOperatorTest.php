<?php


class InOperatorTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    private static $operator;

    protected function _before()
    {
        $containers = $this->tester->getContainerInterface();
        self::$operator = new \SuiteCRM\API\JsonApi\v1\Filters\Operators\Comparators\InOperator($containers);
    }

    protected function _after()
    {
    }

    public function testIsValidTagWithInvalidType()
    {
        $this->tester->expectException(
            new \SuiteCRM\Exception\InvalidArgumentException('[JsonApi][v1][Filters][Operators][Comparators][InOperator][isValid][expected type to be string] $operator'),
            function() {
                self::$operator->isValid(array());
            }
        );
    }

    public function testIsValidTagWithInvalidName()
    {
        $this->assertFalse(self::$operator->isValid(self::$operator->toFilterTag('eq2')));
    }

    public function testToFilterOperator()
    {
        $tag = self::$operator->toFilterTag('in');
        $this->assertEquals(self::$operator->toFilterOperator(), $tag);
    }

    public function testToSqlOperator()
    {
        $sql = 'IN';
        $this->assertEquals(self::$operator->toSqlOperator(), $sql);
    }
}