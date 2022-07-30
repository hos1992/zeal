<?php

namespace App\Actions\Parent;

use App\Models\MParent;


class ParentStoreAction
{
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function __invoke()
    {
        return MParent::create($this->data);
    }

}
