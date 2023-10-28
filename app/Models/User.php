<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @OA\Schema(
 *  schema="User",
 *  title="User",
 *  @OA\Property(
 * 		property="id",
 * 		type="int",
 *      example="1"
 * 	),
 * 	@OA\Property(
 * 		property="name",
 * 		type="string",
 *      example="Jhon"
 * 	),
 * 	@OA\Property(
 * 		property="email",
 * 		type="string",
 *      example="jhon@gmail.com"
 * 	),
 * 	@OA\Property(
 * 		property="password",
 * 		type="string",
 *      example="jhon123"
 * 	),
 * 	@OA\Property(
 * 		property="updated_at",
 * 		type="date",
 *      example="2023-01-01T18:36:12.000000Z"
 * 	),
 * 	@OA\Property(
 * 		property="created_at",
 * 		type="date",
 *      example="2023-01-01T18:36:12.000000Z"
 * 	),
 * )
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
