<?php
namespace Serkancelik17\ApiBase\Request;

use App\Request\Body\IBody;
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

    public function __construct(Header $header,IAuthorization $authorization,Url $url, IBody $body = null)
    {
        $this->setHeader($header);
        $this->setAuthorization($authorization);
        $this->setUrl($url);
        if($body)
            $this->setBody($body);
    }


    public function run() : String {
        $url = $this->getUrl()->get();
        $bodyRaw = ($this->getBody()) ? $this->getBody()->get() : null;

        $client = new Client();
        $res = $client->request('GET',$url);

        dump($res->getBody());exit;

        $response = Http::withOptions(['debug' => $this->debug]);

        if($bodyRaw)
            $response = $response->withBody($bodyRaw,$this->getBody()->getContentType());


        //$headers = array_merge($this->header->getParameters(true),$this->authorization->getParameters(true));
        if($this->authorization instanceof BasicAuthorization) {
            $response = $response->withBasicAuth($this->authorization->getUserName(),$this->authorization->getPassword());
        } elseif ($this->authorization instanceof ApiKeyAuthorization) {
            $this->header->setParameters(array_merge(
                $this->header->getParameters(),
                [new Parameter($this->authorization->getKey(),$this->authorization->getValue())])
            );
        } elseif ($this->authorization instanceof BearerTokenAuthorization) {
            $response = $response->withToken($this->authorization->getToken());
        }

        $response = $response->withHeaders($this->getHeader()->getParameters(true));

        if($this->getMethod() == "GET")
            $response = $response->get($url);
        elseif($this->getMethod() == 'POST')
            $response = $response->post($url);

     return $response->body();
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
