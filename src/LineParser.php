<?php

declare(strict_types=1);

namespace Enginedata;

use Enginedata\Interfaces\ParserInterface;
use Exception;
use Enginedata\Parsers\Parser;
use Enginedata\Interfaces\NodeInterface;
use Enginedata\Interfaces\LineParserInterface;

/**
 * Class LineParser contains 'Object Pool' all parsers
 */
class LineParser implements LineParserInterface
{
    /**
     * @var array Parsers objects
     */
    protected array $parsers;

    public function __construct(array $parsers)
    {
        $parsers = array_flip($parsers);

        foreach ($parsers as $parserClass => &$parser)
        {
            $parser = $parserClass;
        }

        $this->parsers = $parsers;
    }

    /**
     * @param NodeInterface $node
     * @param string $line
     * @return bool
     * @throws Exception
     */
    public function parse(NodeInterface $node, string $line): bool
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
    public function getParser(string $name): ?ParserInterface
    {
        return $this->getParserInstance($name);
    }

    /**
     * @param string $name
     * @return Parser|null
     */
    protected function getParserInstance(string $name): ?ParserInterface
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
