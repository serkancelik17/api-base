<?php

namespace Entegrator\ApiBase\Request\Authorization;

use Entegrator\ApiBase\Abstracts\AuthorizationAbstract;
use Entegrator\ApiBase\Interfaces\AuthorizationInterface;

class DigestAuthorization  extends AuthorizationAbstract implements AuthorizationInterface
{
    private string $userName;
    private string $password;

    /**
     * @param string $userName
     * @param string $password
     */
    public function __construct(string $userName, string $password)
    {
        $this->setUserName($userName);
        $this->setPassword($password);

    }

    /**
     * @return string
     */
    public function getUserName(): string
    {
        return $this->userName;
    }

    /**
     * @param string $userName
     * @return DigestAuthorization
     */
    public function setUserName(string $userName): self
    {
        $this->userName = $userName;
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
     * @return DigestAuthorization
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }


}
