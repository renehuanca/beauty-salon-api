<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 * @OA\Tag(
 *      name="services",
 * )
 */
class ServicesController extends Controller
{
    /**
     * @OA\Get(
     *      path="/services",
     *      tags={"services"},
     *      summary="Get all services",
     *      @OA\Response(
     *          response="200",
     *          description="successful operation",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/Service")
     *          )
     *      )
     * )
     */
    public function index(): JsonResponse
    {
        return response()->json(Service::all(), Response::HTTP_OK);
    }
}
