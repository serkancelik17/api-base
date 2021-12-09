<?php
namespace Entegrator\ApiBase\Abstracts;

use Entegrator\ApiBase\Interfaces\BodyInterface;
use Entegrator\ApiBase\Interfaces\RequestInterface;
use Entegrator\ApiBase\Parameter;
use Entegrator\ApiBase\Interfaces\AuthorizationInterface;
use Entegrator\ApiBase\Request\Header;
use Entegrator\ApiBase\Request\Url;

abstract class RequestAbstract implements RequestInterface
{

    /** @var Parameter[] $parameters */
    private array $parameters = [];
    /** @var Header $header */
    private Header $header;
    /** @var AuthorizationInterface $authorization */
    private AuthorizationInterface $authorization;
    /** @var string $method */
    private string $method = 'GET';
    /** @var Url $url */
    private Url $url;
    private BodyInterface|null $body = null;
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
//        if($this->authorization instanceof BasicAuthorizationInterface) {
//            $credentials = base64_encode($this->authorization->getUserName().":".$this->authorization->getPassword());
//            $this->header->setParameters(array_merge(
//                    $this->header->getParameters(),
//                    [new Parameter("Authorization","Basic ".$credentials)])
//            );
//            //$response = $response->withBasicAuth($this->authorization->getUserName(),$this->authorization->getPassword());
//        } elseif ($this->authorization instanceof ApiKeyAuthorizationInterface) {
//            $this->header->setParameters(array_merge(
//                    $this->header->getParameters(),
//                    [new Parameter($this->authorization->getKey(), $this->authorization->getValue())])
//            );
//        }
////        } elseif ($this->authorization instanceof BearerTokenAuthorizationInterface) {
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
            curl_setopt($ch, CURLOPT_URL, $this->getUrl());
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
                throw new \Exception("Trendyol boş yanıt döndürdü.");
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
     * @return RequestAbstract
     */
    public function setParameters(array $parameters): RequestAbstract
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
     * @return RequestAbstract
     */
    public function setHeader(Header $header): RequestAbstract
    {
        $this->header = $header;
        return $this;
    }

    /**
     * @return AuthorizationInterface
     */
    public function getAuthorization(): AuthorizationInterface
    {
        return $this->authorization;
    }

    /**
     * @param AuthorizationInterface $authorization
     * @return RequestAbstract
     */
    public function setAuthorization(AuthorizationInterface $authorization): RequestAbstract
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
     * @return RequestAbstract
     */
    public function setMethod(string $method): RequestAbstract
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
     * @return RequestAbstract
     */
    public function setUrl(Url $url): RequestAbstract
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return BodyInterface
     */
    public function getBody(): BodyInterface|null
    {
        return $this->body;
    }

    /**
     * @param BodyInterface $body
     * @return RequestAbstract
     */
    public function setBody(BodyInterface $body): RequestAbstract
    {
        $this->body = $body;
        return $this;
    }



}
