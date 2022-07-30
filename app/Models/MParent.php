<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class MParent extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'parents';

    protected $fillable = ['name', 'email'];

    public function partners()
    {
        return $this->belongsToMany(
            MParent::Class,
            'partners',
            'parent_id',
            'related_parent_id');
    }

    public function children()
    {
        return $this->hasMany(Child::class, 'parent_id')
            ->orWhereIn('parent_id', $this->partners->pluck('id'));
    }
}
