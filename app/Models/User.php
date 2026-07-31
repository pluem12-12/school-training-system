<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\MemberProfile;
use App\Models\School; // เพิ่มบรรทัดนี้

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->role === 'admin';
    }

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'student_id',
        'phone',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // ===== Relationships =====

    public function memberProfile()
    {
        return $this->hasOne(MemberProfile::class);
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class, 'student_id');
    }

    public function evaluationsGiven()
    {
        return $this->hasMany(Evaluation::class, 'mentor_id');
    }

    public function studentReports()
    {
        return $this->hasMany(StudentReport::class, 'student_id');
    }

    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'student_id');
    }

    // ===== Role Helpers =====

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isTeacher(): bool
    {
        return $this->role === 'teacher';
    }

    public function isMentor(): bool
    {
        return $this->role === 'mentor';
    }

    public function isStudent(): bool
    {
        return $this->role === 'student';
    }

    public function hasRole(string ...$roles): bool
    {
        return in_array($this->role, $roles);
    }
}