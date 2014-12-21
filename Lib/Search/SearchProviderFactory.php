<?php
namespace Lib\Search;
/**
  creates the provider by enum value
**/
class SearchProviderFactory
{
  public static function create($providerType)
  {
    switch ($providerType)
    {
      case \Lib\Search\Entities\ProvidersEnum::Amazon:
        return new \Lib\Search\SearchProviders\AmazonSearchProvider();
      break;
    }
  }
}
