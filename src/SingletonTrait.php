<?php
namespace Schwaen\Stdlib;

/**
 * SingletonTrait
 */
trait SingletonTrait {

  /**
   * Instance of itselfs
   * @var self
   */
  static private $instance = null;

  /**
   * Return the instance of the used class
   * @return \Schwaen\Stdlib\self
   */
  public static function getInstance() {
    if(self::$instance === null) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  /**
   * private constructor for calling an optional init-Method
   */
  final private function __construct(){
    $this->init();
  }

  private function init() {}
  final private function __clone(){}
  final private function __wakeup(){}
}
