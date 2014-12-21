<?php
namespace Lib\Infra\Helpers;
class SearchResultItemHelper
{
  const CurrencyRegex = "/[£\$€]+/";
  const MoneyRegex    = "/[0-9\.]+/";
  public static function extractCurrency($price)
  {
    $currency = "";

    preg_match(SearchResultItemHelper::CurrencyRegex, $price, $matches);
    $currency = $matches[0];

    if (isset($currency))
      return $currency;
    return false;
  }
  public static function extractMoneyAmount($price)
  {
    preg_match(SearchResultItemHelper::MoneyRegex, $price, $matches);
    $amount = floatval($matches[0]);
    $amount = $matches[0];
    if (isset($amount))
      return $amount;

    return false;
  }

}
