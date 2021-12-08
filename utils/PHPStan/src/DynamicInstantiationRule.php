<?php
declare(strict_types=1);

namespace Utils\PHPStan;

use PhpParser\Node;
use PhpParser\Node\Expr\New_;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;

/**
 * @implements Rule<New_>
 */
final class DynamicInstantiationRule implements Rule
{
    public function getNodeType(): string
    {
        // What node type is this rule interested in? For now: any node type
        return New_::class;
    }

    /**
     * @param New_ $node
     */
    public function processNode(Node $node, Scope $scope): array
    {
        // Return errors for this node. For now: nothing, just print the type of the node
        if ($node->class instanceof \PhpParser\Node\Expr\Variable) {
            return [
                RuleErrorBuilder::message('Dynamic class instantiation is not allowed')->build()
            ];
        }

        return [];
    }
}
