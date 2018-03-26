<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 08.03.17
 * Time: 13:36
 */

namespace rollun\permission\Auth;

use Psr\Http\Message\ServerRequestInterface as Request;
use rollun\actionrender\MiddlewareDeterminator\AttributeParam;
use rollun\permission\Auth\Middleware\Factory\ImplicitRegisterAbstractFactory;

class RegisterMiddlewareDeterminator extends AttributeParam
{
    /**
     * @param Request $request
     * @return string
     */
    protected function getValue(Request $request)
    {
        $resourceName = parent::getValue($request);
        return $resourceName . ImplicitRegisterAbstractFactory::getImplicitPostfix();
    }
}
