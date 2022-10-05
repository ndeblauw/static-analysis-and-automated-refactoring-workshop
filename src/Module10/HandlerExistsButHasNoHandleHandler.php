<?php
declare(strict_types=1);

namespace App\Module10;

final class HandlerExistsButHasNoHandleHandler
{
    public function noHandle(): string
    {
        return 'no';
    }
}
