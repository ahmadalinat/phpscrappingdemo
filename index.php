<?php
require_once 'config.php';
require_once 'bootstrap.php';

$klein->respond('GET', '/task/Search/[:provider]/[:queryString]', function ($request) {
  //set page header as json
  header('Content-Type: application/json');
  //builds provider name
  $providerName = '\Lib\Search\Entities\ProvidersEnum::'.$request->provider;
  //if provider exists
  if (defined ($providerName))
  {
    //get provider name enum value
    $providerEnumValue = constant ($providerName);
    $searchProvider = \Lib\Search\SearchProviderFactory::create($providerEnumValue);
    if ($searchProvider && $searchProvider instanceof \Lib\Search\ISearchProvider)
    {
      //builds the search request
      $req = new \Lib\Search\Entities\SearchRequest();
      $req->queryString = $request->queryString;
      $searchProvider->createSearchRequest($req);
      $response = $searchProvider->getResponse();
      return json_encode(\Lib\Infra\Helpers\JsonResponseFormatterHelper::formatResponse($response));
    }else
      return json_encode(\Lib\Infra\Helpers\JsonErrorHelper::displayProviderNotFoundErrorMessage());

  }

});
$klein->onHttpError(function ($code, $router) {
    switch ($code) {
        case 404:
            $router->response()->body(
                \Lib\Infra\Helpers\JsonErrorHelper::display404ErrorMessage()
            );
            break;
        default:
            $router->response()->body(
              \Lib\Infra\Helpers\JsonErrorHelper::displayUnexpectedErrorMessage($code)
            );
    }
});

$klein->dispatch();
