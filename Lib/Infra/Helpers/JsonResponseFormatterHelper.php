<?php
namespace Lib\Infra\Helpers;
class JsonResponseFormatterHelper
{
  public static function formatResponse(\Lib\Search\Entities\SearchResponse $response)
  {
      $object = new \stdClass();
      $object->status  = 200;
      $object->count   = count($response->SearchResultItems);
      $object->results = $response->SearchResultItems;
      return $object;
  }
}
