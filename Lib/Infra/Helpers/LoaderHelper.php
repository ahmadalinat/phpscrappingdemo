<?php
namespace Lib\Infra\Helpers;
class LoaderHelper
{
  public static function  include_dir($path) {

      if(is_dir($path)) {
          foreach (glob($path.'*') as $filename) {
              if(is_file($filename) && pathinfo($filename, PATHINFO_EXTENSION) == 'php') {
                  require_once $filename;
              } elseif(is_dir($filename)) {
                  LoaderHelper::include_dir($filename.'/');
              }
          }
      }
  }
  public static function autoload($class) {
    $path =  $class . '.php';

    if (file_exists($path)){
      require_once  $path;
    }else
      throw new Exception("file not found!");


  }

}
