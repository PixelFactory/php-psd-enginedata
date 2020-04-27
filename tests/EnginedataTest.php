<?php

use Enginedata\Text;
use Enginedata\Node;
use Enginedata\Config;
use Enginedata\LineParser;
use Enginedata\Enginedata;
use Enginedata\NodeInterface;
use Enginedata\LineParserInterface;

class EnginedataTest extends TestCase
{
    /**
     * @throws ReflectionException
     */
    public function testInitializeEnginedata()
    {
        $nodeClass = Node::class;
        $textClass = Text::class;
        $lineParserClass = LineParser::class;

        $nodeObject = $this->createMock($nodeClass);
        $textObject = $this->createMock($textClass);
        $parserObject = $this->createMock($lineParserClass);

        /**
         * @var NodeInterface $nodeObject
         * @var SeekableIterator $textObject
         * @var LineParserInterface $parserObject
         */
        $enginedata = new Enginedata('', $nodeObject, $textObject, $parserObject);

        $this->assertInstanceOf($nodeClass, $this->getPrivateProperty($enginedata, 'node'));
        $this->assertInstanceOf($textClass, $this->getPrivateProperty($enginedata, 'text'));
        $this->assertInstanceOf($lineParserClass, $this->getPrivateProperty($enginedata, 'parser'));
    }

    public function testConfigInitializeEnginedata()
    {
        $nodeTestClass = 'TestNode';
        $textTestClass = 'TestText';
        $lineParserTestClass = 'TestLineParser';

        // Create mock classes
        eval('
            use Enginedata\NodeInterface;
            use Enginedata\Parsers\Parser;
            use Enginedata\LineParserInterface;

            class ' . $nodeTestClass . ' implements \Enginedata\NodeInterface
            {
                public function getNode(): array{}
                public function setValue($key, $value): void{}
                public function addValue($value): void{}
                public function addNode($key = null): void{}
                public function parentNode(): void{}
            };
            class ' . $textTestClass . ' implements SeekableIterator
            {
                public function seek(int $position){}
                public function current(){}
                public function key(){}
                public function next(){}
                public function rewind(){}
                public function valid(){}
            };
            class ' . $lineParserTestClass . ' implements LineParserInterface
            {
               public function parse(NodeInterface $node, $line): bool{}
               public function getParsers(): array{}
               public function getParser($name): ?Parser{}
            };
        ');

        $enginedata = $this->getMockBuilder(Enginedata::class)
            ->disableOriginalConstructor()
            ->getMock();

        $enginedata->expects($this->exactly(4))
            ->method('getConfig')
            ->will(
                $this->onConsecutiveCalls(
                    $nodeTestClass,
                    $textTestClass,
                    [],
                    $lineParserTestClass
                )
            );


        /** @var $enginedata Enginedata */
        $enginedata->__construct('');
    }

    /**
     * @throws ReflectionException
     * @throws Exception
     */
    public function testParse()
    {
        $text = new ArrayIterator([
            'line_1',
            'line_2',
            'line_3',
        ]);

        $enginedata = $this->getMockBuilder(Enginedata::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['parseLine', 'getNode'])
            ->getMock();

        $this->setPrivateProperty($enginedata, 'text', $text);

        $enginedata->expects($this->exactly($text->count()))->method('parseLine');
        $enginedata->expects($this->once())->method('getNode');
        /** @var Enginedata $enginedata */
        $enginedata->parse();
    }

    /**
     * @throws ReflectionException
     */
    public function testParseLine()
    {
        $line = 'Test Line';
        $lineNumber = 3;

        $enginedata = $this->getMockBuilder(Enginedata::class)
            ->disableOriginalConstructor()
            ->getMock();

        $nodeObject = $this->createMock(Node::class);
        $parserObject = $this->createMock(LineParser::class);

        $parserObject->expects($this->once())->method('parse')->with(
            $this->equalTo($nodeObject),
            $this->equalTo($line)
        );

        $this->setPrivateProperty($enginedata, 'node', $nodeObject);
        $this->setPrivateProperty($enginedata, 'parser', $parserObject);

        $this->callProtectedMethod($enginedata, 'parseLine', [$line, $lineNumber]);
    }

    /**
     * @throws ReflectionException
     */
    public function testParseLineException()
    {
        $line = 'Test Line';
        $lineNumber = 3;
        $errorMessage = 'Test Error';

        $enginedata = $this->getMockBuilder(Enginedata::class)
            ->disableOriginalConstructor()
            ->getMock();


        $nodeObject = $this->createMock(Node::class);
        $parserObject = $this->createMock(LineParser::class);

        $parserObject->expects($this->once())->method('parse')->will(
            $this->throwException(new Exception($errorMessage))
        );

        $this->setPrivateProperty($enginedata, 'node', $nodeObject);
        $this->setPrivateProperty($enginedata, 'parser', $parserObject);

        $this->expectException(Exception::class);
        $this->expectExceptionMessage($errorMessage . ' Line: ' . $lineNumber);

        $this->callProtectedMethod($enginedata, 'parseLine', [$line, $lineNumber]);
    }

    public function testResult()
    {
        $enginedata = $this->getMockBuilder(Enginedata::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getNode'])
            ->getMock();

        $enginedata->expects($this->once())->method('getNode');
        /** @var Enginedata $enginedata */
        $enginedata->result();
    }

    /**
     * @throws ReflectionException
     */
    public function testGetNode()
    {
        $node = $this->getMockBuilder(Node::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getNode'])
            ->getMock();

        $node->expects($this->once())->method('getNode');

        $enginedata = $this->getMockBuilder(Enginedata::class)
            ->disableOriginalConstructor()
            ->setMethodsExcept(['getNode'])
            ->getMock();

        $this->setPrivateProperty($enginedata, 'node', $node);
        /** @var Enginedata $enginedata */
        $enginedata->getNode();
    }

    /**
     * @throws ReflectionException
     */
    public function testGetConfig()
    {
        $mockConfigName = 'MockConfig';
        $configField = 'test';
        // Init mock config
        eval("
            class $mockConfigName
            {
                public const DEFAULT_CONFIG = [
                    '$configField' => stdClass::class,
                ];
            }
        ");

        $config = new $mockConfigName();

        $enginedata = $this->getMockBuilder(Enginedata::class)
            ->disableOriginalConstructor()
            ->setMethodsExcept(['getConfig'])
            ->getMock();

        $this->setPrivateProperty($enginedata, 'config', get_class($config));

        /**
         * @var Config $config
         * @var Enginedata $enginedata
         */
        $this->assertEquals($config::DEFAULT_CONFIG[$configField], $enginedata->getConfig($configField));
    }
}
