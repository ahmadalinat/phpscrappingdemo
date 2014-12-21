<?php
namespace Lib\HttpClient\Providers;
/**
  implement the Http Client using cURL library
**/
class CurlProvider implements \Lib\HttpClient\Providers\IHttpClientProvider
{
  private $request;

  public function createRequest(\Lib\HttpClient\HttpRequest $request)
  {
    $this->request = $request;
  }
  public function sendRequest()
  {
      $curl = curl_init();
      // Set some options - we are passing in a useragent too here
      curl_setopt_array($curl, array(
          CURLOPT_RETURNTRANSFER => 1,
          CURLOPT_URL => $this->request->url,
          CURLOPT_USERAGENT => USER_AGENT,
          CURLOPT_TIMEOUT => REQUEST_TIMEOUT
      ));
      // Send the request & save response to $resp
      $resp = curl_exec($curl);
      // Close request to clear up some resources
      curl_close($curl);

      return $resp;
    }
    /**
      check whether cURL is supported by the server
    **/
    function isSupported()
    {
      if  (in_array  ('curl', get_loaded_extensions())) {
          return true;
      }
      else {
          return false;
      }
    }
}
