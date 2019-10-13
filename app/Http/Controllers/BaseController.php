<?php

namespace App\Http\Controllers;

use App\Traits\FlashMessages;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    use FlashMessages;

    /**
     * @var 
     * 
     */
    protected $data = null;

    /**
     * @param string $title
     * @param string $subtitle
     *  
     */
    protected function setPageTitle($title, $subtitle)
    {
        view()->share(['pageTitle' => $title, 'subTitle' => $subtitle]);
    }

    /**
     * @param int $errorCode
     * @param null $message
     * @return \Illuminate\Http\Response
     */
    protected function showErrorPage($errorCode = 404, $message = null)
    {
        $data['message'] = $message;
        return response()->view('errors.'.$errorCode, $data, $errorCode);
    }

    /**
     * @param bool $error
     * @param int $responseCode
     * @param array $message
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function responseJson($error = true, $responseCode = 200, $message = [], $data = null)
    {
        return response()->json([
            'error' => $error,
            'response_code' => $responseCode,
            'message' => $message,
            'data' => $data
        ]);
    }
}
