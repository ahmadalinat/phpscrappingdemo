<?php
namespace Lib\Search\Entities;
/**
  class represents the response sent to the provider
**/
class SearchResponse
{
  //products to be returned
  public $SearchResultItems;

  function __construct()
  {
    $this->SearchResultItems =  array();
  }
}
