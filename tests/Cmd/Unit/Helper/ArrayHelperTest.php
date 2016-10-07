<?php

namespace Tests\Cmd\Unit\Helper;

use Cmd\Helper\ArrayHelper;

class ArrayHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return array
     */
    public function getToStringProvider()
    {
        return [
            [
                [
                    'a' => 'A',
                    'b' => 'B',
                    'c' => 'C',
                    'd' => 'D',
                ],
                '{
    "a": "A",
    "b": "B",
    "c": "C",
    "d": "D"
}'
            ],
            [
                [
                    '1' => 'a',
                    '2' => 'b',
                    'a' => [
                        'test'
                    ]
                ],
                '{
    "1": "a",
    "2": "b",
    "a": [
        "test"
    ]
}'
            ],
        ];
    }

    /**
     * @test
     * @group helper
     * @dataProvider getToStringProvider
     * @param array $array
     * @param string $expected
     */
    public function toStringTest(array $array, string $expected)
    {
        $this->assertEquals($expected, ArrayHelper::toString($array));
    }
}
