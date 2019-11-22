<?php

declare(strict_types=1);

namespace webignition\BasilActionGenerator\Tests\Unit;

use webignition\BasilActionGenerator\ActionGenerator;
use webignition\BasilModel\Action\ActionInterface;
use webignition\BasilModel\Action\ActionTypes;
use webignition\BasilModel\Action\InteractionAction;
use webignition\BasilModel\Identifier\DomIdentifier;

class ActionGeneratorTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider generateDataProvider
     */
    public function testGenerate(string $actionString, ActionInterface $expectedAction)
    {
        $actionGenerator = ActionGenerator::createGenerator();

        $this->assertEquals($expectedAction, $actionGenerator->generate($actionString));
    }

    public function generateDataProvider(): array
    {
        /**
        'identifierString' => '"//*[@id=\"element-id\"]"',
        'expectedIdentifier' => new DomIdentifier('//*[@id="element-id"]'),
         */

        return [
            'click action, css selector' => [
                'actionString' => 'click ".selector"',
                'expectedAction' => new InteractionAction(
                    'click ".selector"',
                    ActionTypes::CLICK,
                    new DomIdentifier('.selector'),
                    '".selector"'
                ),
            ],
            'click action, xpath expression containing escaped double quotes' => [
                'actionString' => 'click "//*[@id=\"element-id\"]"',
                'expectedAction' => new InteractionAction(
                    'click "//*[@id=\"element-id\"]"',
                    ActionTypes::CLICK,
                    new DomIdentifier('//*[@id="element-id"]'),
                    '"//*[@id=\"element-id\"]"'
                ),
            ],
        ];
    }
}
