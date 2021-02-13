<?php

namespace App\Http\Controllers\API\Repository;

use App\Http\Controllers\Controller;
use App\Http\Resources\RepositoryResource;
use App\Http\Resources\UserResource;
use App\Services\Github\IndexingRepositoriesService;
use Illuminate\Http\Response;

/**
 * Class IndexingRepositoryController
 * @package App\Http\Controllers\API\Repository
 * @author Ahmed Helal Ahmed
 */
class IndexingRepositoryController extends Controller
{

    public function __invoke(IndexingRepositoriesService $service)
    {
        $output=$service->handle();

        if(!$output['status']){
            return response()->json([
                'message'=>'Failed'
            ],Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'message'=>'Successfully done',
            'data'=>[
                'repositories'=>RepositoryResource::collection($output['repositories']),
                'repositories_count' => $output['repositories_count'],
                'user' =>new UserResource(auth()->user())
            ]
        ],Response::HTTP_OK);
    }
}
