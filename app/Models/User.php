<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['nama', 'username', 'password', 'role'])]
#[Hidden(['password'])]
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'id_user';

    // Beritahu Laravel bahwa kolom login adalah 'username', bukan 'email'
    public function getAuthIdentifierName(): string
    {
        return 'username';
    }

    public function pesanans()
    {
        return $this->hasMany(Pesanan::class, 'id_user');
    }

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
