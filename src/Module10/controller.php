<?php

declare(strict_types=1);

use App\Module10\CancelWorkshop;
use App\Module10\CommandBus;
use App\Module10\PlanWorkshop;

require __DIR__ . '/../../vendor/autoload.php';

$commandBus = new CommandBus();

$workshop = $commandBus->handle(new PlanWorkshop('PHPStan'));

// Bug: calling getTitle() but Workshop has no such method
echo $workshop->title();

$commandBus->handle(new CancelWorkshop());

// Bug: calling getTitle() but CancelWorkshopHandler returns void
//echo $workshop->getTitle();
