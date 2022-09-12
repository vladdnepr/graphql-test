<?php

namespace VladDnepr\GraphQLTest\Type;

/**
 * @author Marko Kunic <kunicmarko20@gmail.com>
 */
interface TypeInterface
{
    /**
     * Returns Type in format needed for GraphQL
     */
    public function __invoke($identifier): string;
}
