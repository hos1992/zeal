<?php

namespace App\Actions\Child;

use Illuminate\Support\Facades\Auth;

class ChildUpdateAction
{
    private $id;
    private $data;

    public function __construct(array $data, $id)
    {
        $this->id = $id;
        $this->data = $data;
    }

    public function __invoke()
    {
        $child = Auth::user()->children->where('id', $this->id)->first();
        if (!$child) {
            throw new \Exception("Wrong child id");
        }

        $child->update($this->data);

        return $child;
    }
}
