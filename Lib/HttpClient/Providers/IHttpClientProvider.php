<?php
namespace Lib\HttpClient\Providers;
/**
  interface for all client providers
**/
interface IHttpClientProvider
{
  public function createRequest(\Lib\HttpClient\HttpRequest $request);
  public function sendRequest();
  public function isSupported();
}
