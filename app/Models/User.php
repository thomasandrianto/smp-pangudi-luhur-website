<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory;
    use Notifiable;

    /**
     * Attributes that can be mass assigned.
     *
     * Only allow fields that are safe to be filled
     * from forms or create/update operations.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Attributes hidden when model is serialized.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Attribute casting.
     *
     * - password => automatically hashed
     * - email_verified_at => Carbon instance
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Restrict access to Filament admin panel.
     *
     * Only users with a verified email address
     * can access /admin.
     *
     * If you later add roles, this method is the
     * best place to restrict admin access.
     */
    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    /**
     * User has many announcements.
     */
    public function announcements(): HasMany
    {
        return $this->hasMany(Announcement::class, 'author_id');
    }

    /**
     * User has many events.
     */
    public function events(): HasMany
    {
        return $this->hasMany(Event::class, 'created_by');
    }
}