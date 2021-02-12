<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @OA\Info(
     *      version="1.0.0",
     *      title="Library OpenApi Documentation",
     *      description="Library OpenApi description",
     *      @OA\Contact(
     *          email="petrovsa83@mail.ru"
     *      ),
     *      @OA\License(
     *          name="Apache 2.0",
     *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
     *      )
     * )
     *
     * @OA\Server(
     *      url=L5_SWAGGER_CONST_HOST,
     *      description="Library API Server"
     * )
     *
     * @OA\PathItem(
     *     path="/",
     * )
     *
     * @OA\Tag(
     *     name="Library",
     *     description="API Endpoints of Library"
     * )
     */
}
