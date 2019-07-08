<?php

declare(strict_types=1);

/*
 * This file is part of the Explicit Architecture POC,
 * which is created on top of the Symfony Demo application.
 *
 * (c) Herberto Graça <herberto.graca@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Acme\App\Presentation\Api\GraphQl\Node\User\CreatedPosts;

use ArrayObject;
use GraphQL\Type\Definition\ResolveInfo;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Relay\Connection\Output\Connection;
use Overblog\GraphQLBundle\Resolver\ResolverMap;

final class CreatedPostsConnectionResolverMap extends ResolverMap
{
    /**
     * @var CreatedPostsResolver
     */
    private $createdPostsResolver;

    public function __construct(CreatedPostsResolver $createdPostsResolver)
    {
        $this->createdPostsResolver = $createdPostsResolver;
    }

    public function map(): array
    {
        return [
            'CreatedPostsConnection' => [
                'count' => function (Connection $value, Argument $args, ArrayObject $context, ResolveInfo $info) {
                    return $this->createdPostsResolver->countEdges($value);
                },
                'foo' => function (Connection $value, Argument $args, ArrayObject $context, ResolveInfo $info) {
                    return 'Some metadata about the set of posts created by the user.';
                },
            ],
        ];
    }
}
