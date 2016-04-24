<?php
namespace Schwaen\Stdlib;

/**
 * ArrayUtils
 */
class ArrayUtils {
  /**
   * column
   *
   * @access public
   * @static
   * @param array $input
   * @param string|int $column_key
   * @param string $index_key
   * @return null|array
   */
  public static function column($input, $column_key, $index_key = null) {
    $arr = array_map(function($d) use ($column_key, $index_key) {
      if(!isset($d[$column_key])) {
        return null;
      }
      if($index_key !== null) {
        return [$d[$index_key] => $d[$column_key]];
      }
      return $d[$column_key];
    }, $input);
    if($index_key !== null) {
      $tmp = [];
      foreach($arr as $ar) {
        $tmp[key($ar)] = current($ar);
      }
      $arr = $tmp;
    }
    return $arr;
  }
}