<?php

namespace App\Actions\Parent;

use App\Models\MParent;
use Illuminate\Support\Facades\Auth;

class ParentAssignPartnerAction
{
    private $email;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public function __invoke()
    {

        $partner = MParent::where('email', $this->email)->first();
        if (!$partner) {
            $partner = MParent::create([
                'name' => $this->email,
                'email' => $this->email
            ]);
        }

        Auth::user()->partners()->attach($partner->id);
        $partner->partners()->attach(Auth::user()->id);

        return $partner;
    }
}
