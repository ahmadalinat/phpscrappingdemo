<?php
namespace Lib\Search;
/**
  interface implemented by all search providers such as Amazon
**/
interface ISearchProvider
{
  public function createSearchRequest(\Lib\Search\Entities\SearchRequest $request);
  public function getResponse();
}
