<?php

namespace ApiBase\Request;

use ApiBase\Request\Authorization\IAuthorization;
use Illuminate\Http\Response;

interface IRequest
{
    function createAuthorization() : IAuthorization;
    function createHeader() : Header;
    function run() : string;

}
