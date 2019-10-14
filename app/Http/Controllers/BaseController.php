<?php

namespace App\Http\Controllers;

use App\Traits\FlashMessages;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;

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

    /**
     * @param $route
     * @param string|array $message
     * @param string $type
     * @param bool $error
     */
    protected function responseRedirect($route, $message, $type = 'info', $error = false)
    {
        $this->setFlashMessage($message, $type);
        $this->showFlashMessages();

        if($error){
            $redirectPath = redirect()->back()->withInput();
        }else{
            $redirectPath = redirect()->route($route);
        }

        return $redirectPath;
    }

    /**
     * @param $message
     * @param string $type
     * @param bool $error, 
     */
    protected function responseRedirectBack($message, $type = 'info', $error = false)
    {
        $this->setFlashMessage($message, $type);
        $this->showFlashMessages();

        return redirect()->back();
    }
}
