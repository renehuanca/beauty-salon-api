<?php

namespace App\Http\Controllers;

use App\Enums\ReservationStatus;
use App\Models\Customer;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

/**
 * @OA\Tag(
 *      name="reservations"
 * )
 */
class ReservationController extends Controller
{
    /**
     * @OA\Post(
     *      path="/reservations",
     *      tags={"reservations"},
     *      summary="Create a new reservation",
     *      security={{"sanctum":{}}},
     *      @OA\RequestBody(
     *          @OA\JsonContent(
     *              @OA\Property(property="service_id", type="number", example="1"),
     *              @OA\Property(property="date", type="date", example="2023-01-01"),
     *              @OA\Property(property="time", type="time", example="12:30"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="201",
     *          description="Created",
     *          @OA\JsonContent(
     *              type="object",
     *              ref="#/components/schemas/Reservation"
     *          )
     *      ),
     *      @OA\Response(response="404", description="Not Found"),
     *      @OA\Response(response="422", description="Unprocessable Content"),
     * )
     */
    public function store(Request $request): Response
    {
        $validator = Validator::make($request->all(), [
            'service_id' => 'required|integer',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if (!$customer = $request->user()->customer) {
            return response(['errors' => 'Customer not found'], Response::HTTP_NOT_FOUND);
        }

        $reservation = $customer->reservations()->create([
            'service_id' => $request->service_id,
            'date' => $request->date,
            'time' => $request->time,
            'status' => ReservationStatus::PENDING,
        ]);

        return response($reservation, Response::HTTP_CREATED);
    }

    /**
     * @OA\Get(
     *      path="/customers/{id}/reservations",
     *      tags={"reservations"},
     *      summary="Get reservations of customers",
     *      security={{"sanctum":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="The customer id",
     *          @OA\Schema(type="string")
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="successfull operation",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/Service")
     *          )
     *      ),
     *     @OA\Response(response="404", description="Not Found"),
     * )
     */
    public function index(string $id): Response
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return response(['errors' => 'Customer not found'], Response::HTTP_NOT_FOUND);
        }

        return response($customer->reservations, Response::HTTP_OK);
    }

    /**
     * @OA\Delete(
     *      path="/reservations/{id}",
     *      tags={"reservations"},
     *      summary="Delete the reservation",
     *      security={{"sanctum":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="The reservation id to delete",
     *          @OA\Schema(type="string")
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="successfull operation",
     *          @OA\JsonContent(
     *              type="object",
     *              ref="#/components/schemas/Reservation"
     *          )
     *      ),
     *      @OA\Response(response="404", description="Not Found"),
     * )
     */
    public function destroy(string $id): Response
    {
        try {
            $reservation = Reservation::find($id);
            $reservation->delete();

            return response($reservation, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response(['errors' => 'Reservation not found'], Response::HTTP_NOT_FOUND);
        }
    }
}
