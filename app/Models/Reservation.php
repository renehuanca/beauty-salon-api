<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *  schema="Reservation",
 *  title="Reservation",
 *  @OA\Property(
 * 		property="id",
 * 		type="int",
 *      example="1"
 * 	),
 * 	@OA\Property(
 * 		property="customer_id",
 * 		type="number",
 *      example="1"
 * 	),
 * 	@OA\Property(
 * 		property="service_id",
 * 		type="number",
 *      example="1"
 * 	),
 * 	@OA\Property(
 * 		property="date",
 * 		type="date",
 *      example="2023-01-01"
 * 	),
 * 	@OA\Property(
 * 		property="time",
 * 		type="time",
 *      example="10:10"
 * 	),
 * 	@OA\Property(
 * 		property="status",
 * 		type="string",
 *      enum={"pending", "confirmed", "cancelled"},
 *      example="pending"
 * 	),
 * 	@OA\Property(
 * 		property="updated_at",
 * 		type="date-time",
 *      example="2023-01-01T18:36:12.000000Z"
 * 	),
 * 	@OA\Property(
 * 		property="created_at",
 * 		type="date-time",
 *      example="2023-01-01T18:36:12.000000Z"
 * 	),
 * )
 */
class Reservation extends Model
{
    use HasFactory;
}
