<?php
namespace Lib\Infra\Helpers;
class JsonErrorHelper
{
  public static function display404ErrorMessage()
  {
    $object = JsonErrorHelper::formatErrorMessage(404,"Cannot find requested path");
    return json_encode($object);
  }
  public static function displayProviderNotFoundErrorMessage()
  {
    $object = JsonErrorHelper::formatErrorMessage(-1,"Provider not Found");
    return json_encode($object);
  }
  public static function displayUnexpectedErrorMessage($code)
  {
    $object = JsonErrorHelper::formatErrorMessage($code,"unexcpected Error");
    return json_encode($object);
  }
  private static function formatErrorMessage($status,$message)
  {
    $object = new \stdClass();
    $object->Status  = $status;
    $object->Message = $message;
    return $object;
  }

}
