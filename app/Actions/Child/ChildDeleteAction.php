<?php

namespace App\Actions\Child;

use App\Models\Child;
use Illuminate\Support\Facades\Auth;

class ChildDeleteAction
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function __invoke()
    {
        $child = Child::where([
            ['id', '=', $this->id],
            ['parent_id', '=', Auth::user()->id]
        ])->first();

        if (!$child) {
            throw new \Exception("You can only delete the children added by you !");
        }

        $child->delete();

        return [];
    }
}
