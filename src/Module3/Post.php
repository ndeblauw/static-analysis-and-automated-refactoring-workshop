<?php

declare(strict_types=1);

namespace App\Module3;

use App\Module2\Mapping;

final class Post
{
    private function __construct(
        private string $title
    ) {
    }

    /**
     * @param array<string,string|null> $data
     */
    public static function fromArray(array $data): self
    {
        return new self(Mapping::getString($data, 'title'));
    }

    /**
     * @return array<string,string>
     */
    public function toArray(): array
    {
        return [
            'title' => $this->title,
        ];
    }
}
