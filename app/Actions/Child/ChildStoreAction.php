<?php

namespace App\Actions\Child;

use Illuminate\Support\Facades\Auth;

class ChildStoreAction
{
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function __invoke()
    {
        return Auth::user()->children()->create([
            'name' => $this->name,
        ]);
    }

}
