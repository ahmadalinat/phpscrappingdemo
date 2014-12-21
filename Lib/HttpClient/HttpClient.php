<?php
namespace Lib\HttpClient;
/**
  defines the http client class
**/
class  HttpClient
{
  private $provider;
  function  __construct (\Lib\HttpClient\Providers\IHttpClientProvider $provider)
  {
    $this->provider = $provider;
  }
  public function createRequest(\Lib\HttpClient\HttpRequest $request)
  {
    $this->provider->createRequest($request);

  }
  public function sendRequest()
  {
    return $this->provider->sendRequest();
  }
}
