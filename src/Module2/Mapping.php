<?php

namespace App\Module2;

use Assert\Assertion;

class Mapping
{
    /**
     * @param array<string,string|null> $record
     * @param string $key
     * @return string
     * @throws \Assert\AssertionFailedException
     */
    public static function getString(array $record, string $key): string
    {
        Assertion::keyExists($record, $key);
        Assertion::string($record[$key]);

        return $record[$key];

    }


    /**
     * @param array<string,string|null> $record
     * @param string $key
     * @return int
     * @throws \Assert\AssertionFailedException
     */
    public static function getInteger(array $record, string $key): int
    {
        Assertion::keyExists($record, $key);
        Assertion::string($record[$key]);

        return (int) $record[$key];

    }

}
