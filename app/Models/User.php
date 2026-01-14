<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
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
     * Check if user is admin
     */
    public function isAdmin()
    {
        // ये check करने के लिए कि user admin है या नहीं
        // आपके database structure पर depend करता है
        
        // Method 1: अगर आपके पास 'role' column है
        if (isset($this->role)) {
            return $this->role === 'admin' || $this->role === 'administrator';
        }
        
        // Method 2: अगर आपके पास 'is_admin' column है
        if (isset($this->is_admin)) {
            return (bool) $this->is_admin;
        }
        
        // Method 3: अगर आपके पास 'type' column है
        if (isset($this->type)) {
            return $this->type === 'admin';
        }
        
        // Default: false return करें
        return false;
    }

    /**
     * Check if user has any role
     */
    public function hasRole($role)
    {
        if (isset($this->role)) {
            return $this->role === $role;
        }
        return false;
    }
}
