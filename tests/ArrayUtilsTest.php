<?php
namespace Schwaen\Stdlib;

/**
 * ArrayUtilsTest
 */
class ArrayUtilsTest extends \PHPUnit_Framework_TestCase {

  /**
   * Test for Schwaen\Stdlib\ArrayUtils::column
   */
  public function testColumn() {
    $array = [
      ['id'=>1, 'name'=>'Sven'],
      ['id'=>2, 'name'=>'Hans'],
      ['id'=>5, 'name'=>'Peter'],
    ];
    $this->assertEquals(['Sven','Hans','Peter'], ArrayUtils::column($array, 'name'));
    $this->assertEquals([1,2,5], ArrayUtils::column($array, 'id'));
    $this->assertEquals([1=>'Sven',2=>'Hans',5=>'Peter'], ArrayUtils::column($array, 'name', 'id'));
    $this->assertEquals(count(ArrayUtils::column($array, 'id')), 3);
  }

  /**
   * Test for Schwaen\Stdlib\ArrayUtils::hasStringKeys
   */
  public function testHasStringKeys() {
    $array1 = ['a'=>true,2=>true];
    $array2 = ['test', 'test', 'test'];
    $this->assertEquals(true, ArrayUtils::hasStringKeys($array1, false, false));
    $this->assertEquals(false, ArrayUtils::hasStringKeys($array1, true, false));
    $this->assertEquals(false, ArrayUtils::hasStringKeys($array2));
  }

  /**
   * Test for Schwaen\Stdlib\ArrayUtils::hasStringKeys
   */
  public function testHasIntegerKeys() {
    $array1 = ['a'=>true,2=>true];
    $array2 = ['test', 'test', 'test'];
    $this->assertEquals(true, ArrayUtils::hasIntegerKeys($array1, false));
    $this->assertEquals(false, ArrayUtils::hasIntegerKeys($array1, true));
    $this->assertEquals(true, ArrayUtils::hasIntegerKeys($array2));
  }

  /**
   * Test for Schwaen\Stdlib\ArrayUtils::findValueByKeys
   */
  public function testFindValueByKeys() {
    $arr1 = ['name' => 'Sven', 'Name' => 'Max'];
    $this->assertEquals(null, ArrayUtils::findValueByKeys($arr1, ['test', 'test2']));
    $this->assertEquals('Max', ArrayUtils::findValueByKeys($arr1, ['test', 'Name']));
    $this->assertEquals('Karl', ArrayUtils::findValueByKeys($arr1, ['test', 'test2'], 'Karl'));
  }
}