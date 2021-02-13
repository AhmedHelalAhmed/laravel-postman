<?php

namespace App\Http\Controllers\API\Token;

use App\Http\Controllers\Controller;
use App\Http\Requests\Token\GenerateTokenRequest;
use App\Services\Token\GeneratingTokenService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 * Class GeneratingTokenController
 * @package App\Http\Controllers\API\Token
 * @author Ahmed Helal Ahmed
 * @
 */
class GeneratingTokenController extends Controller
{
    /**
     * @param GenerateTokenRequest $request
     * @param GeneratingTokenService $service
     * @return JsonResponse
     */
    public function __invoke(
        GenerateTokenRequest $request,
        GeneratingTokenService $service) {

        try {
            $output=$service->handle($request->validated());

            if(!$output['status']){
                return response()->json([
                    'message'=>'Failed'
                ],Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            return response()->json([
                'message'=>'Successfully done',
                'data'=> $output['token']
            ],Response::HTTP_OK);

        }catch (Exception $e){
            return response()->json([
                'message'=>$e->getMessage()
            ],Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }
}
