<?php

declare(strict_types=1);

namespace webignition\BasilActionGenerator;

use webignition\BasilModel\Action\ActionInterface;
use webignition\BasilModelFactory\Action\ActionFactory;
use webignition\BasilModelFactory\Exception\InvalidActionTypeException;
use webignition\BasilModelFactory\Exception\InvalidIdentifierStringException;
use webignition\BasilModelFactory\Exception\MissingValueException;
use webignition\BasilParser\ActionParser;

class ActionGenerator
{
    private $actionParser;
    private $actionFactory;

    public function __construct(ActionParser $actionParser, ActionFactory $actionFactory)
    {
        $this->actionParser = $actionParser;
        $this->actionFactory = $actionFactory;
    }

    public static function createGenerator(): ActionGenerator
    {
        return new ActionGenerator(
            ActionParser::create(),
            ActionFactory::createFactory()
        );
    }

    /**
     * @param string $actionString
     *
     * @return ActionInterface
     *
     * @throws InvalidActionTypeException
     * @throws InvalidIdentifierStringException
     * @throws MissingValueException
     */
    public function generate(string $actionString): ActionInterface
    {
        $actionData = $this->actionParser->parse($actionString);

        return $this->actionFactory->createFromActionData($actionData);
    }
}
