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
        return [
            'default' => [
                'actionString' => 'click ".selector"',
                'expectedAction' => new InteractionAction(
                    'click ".selector"',
                    ActionTypes::CLICK,
                    new DomIdentifier('.selector'),
                    '".selector"'
                ),
            ],
        ];
    }
}
