<?php declare(strict_types=1);

namespace Temper\NullableProperties\Tests;

use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\TestCase;
use Temper\NullableProperties\NullableProperties;

class NullablePropertiesTest extends TestCase
{
    /** @dataProvider provides_values */
    public function test_it_converts_empty_strings_to_null($propertyName, $initialValue, $expectedResult)
    {
        /** @var Model $model */
        $model = new class() extends Model {
            use NullableProperties;

            protected $nullable = ['nullableProperty'];
            public function save(array $options = []) { return $this->fireModelEvent('saving'); }
        };

        $model->$propertyName = $initialValue;

        $this->assertEquals($initialValue, $model->$propertyName);
        $this->assertEquals(true, $model->save());
        $this->assertEquals($expectedResult, $model->$propertyName);
    }

    public function provides_values()
    {
        return [
            ['nullableProperty', '', null],
            ['nullableProperty', 'string', 'string'],
            ['nullableProperty', null, null],
            ['nullableProperty', [], []],
            ['nullableProperty', false, false],
            ['nullableProperty', 0, 0],
            ['otherProperty', '', ''],
        ];
    }
}


