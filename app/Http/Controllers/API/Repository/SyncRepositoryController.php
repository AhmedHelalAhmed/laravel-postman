<?php

namespace App\Http\Controllers\API\Repository;

use App\Http\Controllers\Controller;
use App\Services\Github\SyncRepositoriesService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 * Class SyncRepositoryController
 * @package App\Http\Controllers\API\Repository
 * @author Ahmed Helal Ahmed
 */
class SyncRepositoryController extends Controller
{
    /**
     * @param SyncRepositoriesService $service
     * @return JsonResponse
     */
    public function __invoke(SyncRepositoriesService $service)
    {

        $output=$service->handle([
                'name'=>auth()->user()->name
            ]);

        if(!$output['status']){
            return response()->json([
                'message'=>'Failed'
            ],Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'message'=>'Successfully done'
        ],Response::HTTP_OK);
    }
}
