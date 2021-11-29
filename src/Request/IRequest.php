<?php

namespace Serkancelik17\ApiBase\Request;

use Serkancelik17\ApiBase\Request\Authorization\IAuthorization;

interface IRequest
{
    function createAuthorization() : IAuthorization;
    function createHeader() : Header;
    function run() : string;

}
