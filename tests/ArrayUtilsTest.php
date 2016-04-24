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
    $this->assertEquals([1=>'Sven',2=>'Hans',5=>'Peterr'], ArrayUtils::column($array, 'name', 'id'));
  }
}