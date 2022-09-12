<?php

namespace VladDnepr\GraphQLTest\Operation;

use VladDnepr\GraphQLTest\Formatter\FieldsFormatter;
use VladDnepr\GraphQLTest\Formatter\FormatterInterface;
use VladDnepr\GraphQLTest\Formatter\ParametersFormatter;

/**
 * @author Marko Kunic <kunicmarko20@gmail.com>
 */
abstract class Operation
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $parameters;

    /**
     * @var array
     */
    private $fields;

    /**
     * @var FormatterInterface[]
     */
    private $formatters;

    public function __construct(string $name, array $parameters = [], array $fields = [])
    {
        $this->name = $name;
        $this->parameters = $parameters;
        $this->fields = $fields;

        $this->initializeFormatters();
    }

    protected function initializeFormatters(): void
    {
        $this->addFormatter('parameters', new ParametersFormatter());
        $this->addFormatter('fields', new FieldsFormatter());
    }

    public function addFormatter(string $name, FormatterInterface $formatter): void
    {
        $this->formatters[$name] = $formatter;
    }

    public function __invoke(): string
    {
        return <<<GQL
{$this->getOperationName()} {
  $this->name {$this->invokeFormatter('parameters', $this->parameters)}{$this->invokeFormatter('fields', $this->fields)}
}
GQL;
    }

    private function invokeFormatter(string $name, array $data): string
    {
        return $this->getFormatter($name)($data);
    }

    private function getFormatter(string $name): FormatterInterface
    {
        if (isset($this->formatters[$name])) {
            return $this->formatters[$name];
        }

        throw new \InvalidArgumentException(sprintf('Formatter "%s" not found.', $name));
    }

    abstract public function getOperationName(): string;
}
