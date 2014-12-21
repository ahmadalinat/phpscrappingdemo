<?php
namespace Lib\Search\SearchProviders;

class AmazonSearchProvider implements \Lib\Search\ISearchProvider
{
  public $urlFormat = "http://www.amazon.com/s/ref=nb_sb_noss_1?url=search-alias=aps&field-keywords=%s";
  public $requestUrl;
  public  $searchRequest;

  public function createSearchRequest(\Lib\Search\Entities\SearchRequest $request)
  {
    $this->searchRequest = $request;
    $this->_prepareUrl();
  }
  public function getResponse()
  {
      $response = new \Lib\Search\Entities\SearchResponse();
      //parse the page using domDocument
      $doc = new \DOMDocument();
      $html = $this->_getHTMLResponse($this->requestUrl);
      @$doc->loadHTML($html);
      $finder = new \DomXPath($doc);
      $nodes = $finder->query("//*[contains(@class, 's-result-item')]");
      $thumbnails = $finder->query("//*[contains(@alt, 'Product Details')]");
      $urlNodes = $finder->query("//*[contains(@class, 'a-link-normal s-access-detail-page a-text-normal')]");
      if ($nodes->length > 0 )
      {
        foreach ($nodes as $index=>$node){
          if ($index >= MAX_SEARCH_RESULTS_PER_PAGE)
            return $response;

          if ($node->tagName == "li"){

            $urlNode = $urlNodes->item($index);
            $url = $urlNode->getAttribute("href");
            $text = $urlNode->nodeValue;
            $item = new \Lib\Search\Entities\SearchResultItem();
            $item->title = \Lib\Infra\Filters::filterText($text);
            $item->url   = \Lib\Infra\Filters::filterUrl($url);
            $item->thumbnail = $thumbnails->item($index)->getAttribute("src");
            //validate product url before submitting a request
            if (\Lib\Infra\Validators::validateUrl($url))
            {
              //$item = $this->_fillSearchResultItem($item);
            //  if (!$item)
              //  continue;
              //add the item to the results if its valid
              $item = \Lib\Infra\Filters::filterSearchResultItem($item);
              if (\Lib\Infra\Validators::validateSearchResultItem($item))
                array_push($response->SearchResultItems,$item);

            }

          }

        }
      }
      return $response;
  }


  private function _getHTMLResponse($url)
  {
    $response = "";
    try
    {
      $provider = $this->_determineHttpProvider();
      $httpRequest = new \Lib\HttpClient\HttpRequest();
      $httpRequest->url = $url;
      $client = new \Lib\HttpClient\HttpClient($provider);
      $client->createRequest($httpRequest);
      $response = $client->sendRequest();
    }
    catch (Exception $ex)
    {

    }
    return $response;

  }
  /**
    determines best http provider supported in the system
  **/
  private function _determineHttpProvider()
  {
    $curlProvider =  new \Lib\HttpClient\Providers\CurlProvider($this->request);
    if ($curlProvider->isSupported())
      return $curlProvider;

    return new \Lib\HttpClient\Providers\BasicProvider($this->request);
  }
  /**
    prepare url to be sent via http request
  **/
  private function _prepareUrl()
  {
      $this->searchRequest->queryString = urlencode($this->searchRequest->queryString);
      $this->requestUrl =  sprintf($this->urlFormat,$this->searchRequest->queryString);
  }
}
