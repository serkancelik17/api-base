<?php

namespace Entegrator\ApiBase\Request\Authorization;

use Entegrator\ApiBase\Interfaces\AuthorizationInterface;

class BearerTokenAuthorization implements AuthorizationInterface
{
    private string $token;
    private string $username;
    private string $password;


    public function __construct(string $token)
    {
        $this->setToken($token);
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return BearerTokenAuthorization
     */
    public function setToken(string $token): self
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return BearerTokenAuthorization
     */
    public function setUsername(string $username): self
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return BearerTokenAuthorization
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }





}
