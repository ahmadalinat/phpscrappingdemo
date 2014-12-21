<?php
namespace Lib\Infra;
class Validators
{
  public static function validateSearchResultItem(\Lib\Search\Entities\SearchResultItem $item)
  {
    return true;
  }
  public static function validateText($text)
  {
    return !empty($text);
  }
  public static function validateUrl($url)
  {
    return filter_var($url, FILTER_VALIDATE_URL);
  }
  public static function validatePrice($price)
  {
    return $price > 0;
  }
}
