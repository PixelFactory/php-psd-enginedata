<?php

namespace Enginedata;

use Enginedata\Parsers\Parser;
use Exception;

/**
 * Class LineParser contains 'Object Pool' all parsers
 */
class LineParser implements LineParserInterface
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
     * @param NodeInterface $node
     * @param $line
     * @return bool
     * @throws Exception
     */
    public function parse(NodeInterface $node, $line): bool
    {
        foreach ($this->getParsers() as $parserName) {
            $parser = $this->getParser($parserName);
            if ($parser && $parser->startParsing($node, $line)) {
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
     * @return Parser|null
     */
    public function getParser($name): ?Parser
    {
        return $this->getParserInstance($name);
    }

    /**
     * @param $name
     * @return Parser|null
     */
    protected function getParserInstance($name): ?Parser
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
