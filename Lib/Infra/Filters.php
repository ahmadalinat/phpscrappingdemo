<?php
namespace Lib\Infra;
class Filters
{
  public static function filterSearchResultItem(\Lib\Search\Entities\SearchResultItem $item)
  {
    return $item;
  }
  public static function filterText($text)
  {
    return trim($text);
  }
  public static function filterUrl($url)
  {
    return trim($url);
  }
  public static function filterPrice($price)
  {
    return floatval($price);
  }
}
