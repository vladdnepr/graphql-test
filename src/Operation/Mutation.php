<?php

namespace VladDnepr\GraphQLTest\Operation;

/**
 * @author Marko Kunic <kunicmarko20@gmail.com>
 */
final class Mutation extends Operation implements MutationInterface
{
    public function getOperationName(): string
    {
        return 'mutation';
    }
}
