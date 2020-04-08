<?php

namespace Enginedata;

use Enginedata\Parsers\Parser;
use Exception;

/**
 * Class LineParser contains 'Object Pool' all parsers
 */
class LineParser implements ParseLine
{
    /**
     * @var array Parsers objects
     */
    protected array $parsers;

    public function __construct($parsers)
    {
        $this->parsers = $parsers;
    }

    /**
     * @param Node $node
     * @param $line
     * @return bool
     * @throws Exception
     */
    public function parse(Node $node, $line): bool
    {
        foreach ($this->getParsers() as $parser) {
            if ($this->getParser($parser)->startParsing($node, $line)) {
                return true;
            }
        }

        throw new Exception('Parser not found.');
    }

    /**
     * @return array Classes names
     */
    public function getParsers(): array
    {
        return array_keys($this->parsers);
    }

    /**
     * @param string $name Parser class name
     * @return Parser
     */
    public function getParser($name): Parser
    {
        return $this->getParserInstance($name);
    }

    /**
     * @param $name
     * @return Parser|null
     */
    protected function getParserInstance($name): Parser
    {
        if (!isset($this->parsers[$name])) {
            return null;
        }

        if (is_string($this->parsers[$name])) {
            $this->parsers[$name] = new $this->parsers[$name]();
        }

        return $this->parsers[$name];
    }
}
