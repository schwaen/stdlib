<?php
namespace Schwaen\Stdlib;

/**
 * StringUtils
 */
class StringUtils
{

  /**
   * Split a string on every UpperCase letter
   * @access public
   * @static
   * @param string $string
   * @throws \InvalidArgumentException
   * @return array
   */
  public static function splitOnUpperCase($string)
  {
    if (!is_string($string)) {
      throw new \InvalidArgumentException('$string should be a string. '.gettype($string).' is given');
    }
    return preg_split('/(?=[A-Z])/', $string, -1, PREG_SPLIT_NO_EMPTY);
  }

  /**
   * Split a string on every LowerCase letter
   * @access public
   * @static
   * @param string $string
   * @throws \InvalidArgumentException
   * @return array
   */
  public static function splitOnLowerCase($string)
  {
    if (!is_string($string)) {
      throw new \InvalidArgumentException('$string should be a string. '.gettype($string).' is given');
    }
    return preg_split('/(?=[a-z])/', $string, -1, PREG_SPLIT_NO_EMPTY);
  }
}