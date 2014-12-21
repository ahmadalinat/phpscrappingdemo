<?php
namespace Lib\HttpClient\Providers;
/**
  basic http provider - to fallback to if other providers are not supported
**/
class BasicProvider implements \Lib\HttpClient\Providers\IHttpClientProvider
{
    private $request;

    public function createRequest(HttpRequest $request)
    {
      $this->request = $request;
    }
    public function sendRequest()
    {
      return get_file_contents($this->request->url);
    }
    function isSupported()
    {
      return true;
    }
}
