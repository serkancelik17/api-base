<?php
namespace Serkancelik17\ApiBase\Request;

use Serkancelik17\ApiBase\Request\Body\IBody;
use GuzzleHttp\Client;
use Serkancelik17\ApiBase\Parameter;
use Serkancelik17\ApiBase\Request\Authorization\ApiKeyAuthorization;
use Serkancelik17\ApiBase\Request\Authorization\BasicAuthorization;
use Serkancelik17\ApiBase\Request\Authorization\BearerTokenAuthorization;
use Serkancelik17\ApiBase\Request\Authorization\IAuthorization;

abstract class BaseRequest
{

    /** @var Parameter[] $parameters */
    private array $parameters = [];
    /** @var Header $header */
    private Header $header;
    /** @var IAuthorization $authorization */
    private IAuthorization $authorization;
    /** @var string $method */
    private string $method = 'GET';
    /** @var Url $url */
    private Url $url;
    private IBody|null $body = null;
    private bool $debug = true;

//    public function run() : String {
//        $client = new Client();
//        $url = $this->getUrl()->get();
//        $bodyRaw = ($this->getBody()) ? $this->getBody()->get() : null;
//
//
////        if($bodyRaw)
////            $response = $response->withBody($bodyRaw,$this->getBody()->getContentType());
//
//
//        //$headers = array_merge($this->header->getParameters(true),$this->authorization->getParameters(true));
//        if($this->authorization instanceof BasicAuthorization) {
//            $credentials = base64_encode($this->authorization->getUserName().":".$this->authorization->getPassword());
//            $this->header->setParameters(array_merge(
//                    $this->header->getParameters(),
//                    [new Parameter("Authorization","Basic ".$credentials)])
//            );
//            //$response = $response->withBasicAuth($this->authorization->getUserName(),$this->authorization->getPassword());
//        } elseif ($this->authorization instanceof ApiKeyAuthorization) {
//            $this->header->setParameters(array_merge(
//                    $this->header->getParameters(),
//                    [new Parameter($this->authorization->getKey(), $this->authorization->getValue())])
//            );
//        }
////        } elseif ($this->authorization instanceof BearerTokenAuthorization) {
////            $response = $response->withToken($this->authorization->getToken());
////        }
//
//        $response = $client->request($this->getMethod(),$url,['headers' => $this->getHeader()->getParameters(true)]);
//
//        //$response = $response->withHeaders($this->getHeader()->getParameters(true));
////
////        if($this->getMethod() == "GET")
////            $response = $response->get($url);
////        elseif($this->getMethod() == 'POST')
////            $response = $response->post($url);
//
//     return $response->getBody();
//    }

    public function run() : String {
            $ch = curl_init();
            $url = $this->getUrl()->get();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $this->method);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLINFO_HEADER_OUT, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 20);

            //curl_setopt($ch, CURLOPT_USERAGENT, $this->userAgent());

            if ($this->getMethod() == 'POST') {
                curl_setopt($ch, CURLOPT_POST, 1);
                //curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestData));
            }
            $header[] = "Authorization: Basic ".base64_encode($this->getAuthorization()->getUsername().":".$this->getAuthorization()->getPassword());
            curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
            $response = trim(curl_exec($ch));
            if (empty($response)) {
                throw new \Exception("TrendyolService boş yanıt döndürdü.");
            }

            //$response = json_decode($response);
            curl_close($ch);
            return $response;
        }

    /** GETTER AND SETTERS */

    /**
     * @return Parameter[]
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * @param Parameter[] $parameters
     * @return BaseRequest
     */
    public function setParameters(array $parameters): BaseRequest
    {
        $this->parameters = $parameters;
        return $this;
    }

    /**
     * @return Header
     */
    public function getHeader(): Header
    {
        return $this->header;
    }

    /**
     * @param Header $header
     * @return BaseRequest
     */
    public function setHeader(Header $header): BaseRequest
    {
        $this->header = $header;
        return $this;
    }

    /**
     * @return IAuthorization
     */
    public function getAuthorization(): IAuthorization
    {
        return $this->authorization;
    }

    /**
     * @param IAuthorization $authorization
     * @return BaseRequest
     */
    public function setAuthorization(IAuthorization $authorization): BaseRequest
    {
        $this->authorization = $authorization;
        return $this;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param string $method
     * @return BaseRequest
     */
    public function setMethod(string $method): BaseRequest
    {
        $this->method = $method;
        return $this;
    }

    /**
     * @return Url
     */
    public function getUrl(): Url
    {
        return $this->url;
    }

    /**
     * @param Url $url
     * @return BaseRequest
     */
    public function setUrl(Url $url): BaseRequest
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return IBody
     */
    public function getBody(): IBody|null
    {
        return $this->body;
    }

    /**
     * @param IBody $body
     * @return BaseRequest
     */
    public function setBody(IBody $body): BaseRequest
    {
        $this->body = $body;
        return $this;
    }



}
