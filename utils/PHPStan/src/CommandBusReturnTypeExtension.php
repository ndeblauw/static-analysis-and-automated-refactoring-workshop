<?php

declare(strict_types=1);

namespace Utils\PHPStan;

use App\Module10\CommandBus;
use PhpParser\Node\Expr\MethodCall;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\ParametersAcceptorSelector;
use PHPStan\Reflection\ReflectionProvider;
use PHPStan\Type\DynamicMethodReturnTypeExtension;
use PHPStan\Type\Type;
use PHPStan\Type\ObjectType;


final class CommandBusReturnTypeExtension implements DynamicMethodReturnTypeExtension
{
    public function __construct(private ReflectionProvider $reflectionProvider)
    {
    }

    public function getClass(): string
    {
        // This type extension can resolve the return type for a method of the class CommandBus
        return CommandBus::class;
    }

    public function isMethodSupported(MethodReflection $methodReflection): bool
    {
        // This type extension can resolve the return type for the handle() method of CommandBus
        return $methodReflection->getName() === 'handle';
    }

    public function getTypeFromMethodCall(
        MethodReflection $methodReflection,
        MethodCall $methodCall,
        Scope $scope
    ): ?Type {
        // TODO: return the return type of [CommandClass]Handler::handle() instead
        if($methodCall->getArgs() === []) {
            return null;
        }

        $command = $methodCall->getArgs()[0];
        $type = $scope->getType($command->value);
        if(! $type instanceof ObjectType) {
            return null;
        }

        $handlerClassName = $type->getClassName().'Handler';

        if (!$this->reflectionProvider->hasClass($handlerClassName)) {
            return null;
        }

        $handlerHandleMethod = $this->reflectionProvider
            ->getClass($handlerClassName)
            ->getMethod('handle', $scope);

        // By default, return the return type of CommandBus::handle() (or just null)
        return ParametersAcceptorSelector::selectFromArgs(
            $scope,
            $methodCall->getArgs(),
            $handlerHandleMethod->getVariants()
        )->getReturnType();
    }
}
