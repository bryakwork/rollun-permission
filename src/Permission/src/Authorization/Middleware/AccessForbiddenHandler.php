<?php
/**
 * @copyright Copyright © 2014 Rollun LC (http://rollun.com/)
 * @license LICENSE.md New BSD License
 */

namespace rollun\permission\Authorization\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Authentication\UserInterface;

class AccessForbiddenHandler implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $roles = $request->getAttribute(RoleResolver::KEY_ATTRIBUTE_ROLE);
        $resource = $request->getAttribute(ResourceResolver::KEY_ATTRIBUTE_RESOURCE);
        $privilege = $request->getAttribute(PrivilegeResolver::KEY_ATTRIBUTE_PRIVILEGE);
        $user = $request->getAttribute(UserInterface::class);

        $body[] = "Access forbidden for '{$user->getIdentity()}'";

        if (!empty($roles)) {
            $body[] = "with roles = " . json_encode($roles);
        }

        if (!empty($resource)) {
            $body[] = "with resource = '$resource'";
        }

        if (!empty($privilege)) {
            $body[] = "with privilege = '$privilege'";
        }

        return new JsonResponse(implode(', ', $body), 403);
    }
}
