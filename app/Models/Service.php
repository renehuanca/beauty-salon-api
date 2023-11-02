<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *  schema="Service",
 *  title="Service",
 *  @OA\Property(
 * 		property="id",
 * 		type="int",
 *      example="1"
 * 	),
 * 	@OA\Property(
 * 		property="name",
 * 		type="string",
 *      example="manicure"
 * 	),
 * 	@OA\Property(
 * 		property="description",
 * 		type="string",
 *      example="Manicure of nails"
 * 	),
 * 	@OA\Property(
 * 		property="price",
 * 		type="float",
 *      example="10.50"
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
class Service extends Model
{
    use HasFactory;
}
