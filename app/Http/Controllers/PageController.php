<?php

namespace App\Http\Controllers;

use App\Services\JsonRpcRequestAsync;

class PageController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @var $page null|string
     *
     */
    public function index($page = null)
    {
        $jsonRpcRequestAsync = new JsonRpcRequestAsync('addStatistic', [
            'url' => request()->url()
        ]);

        $response = json_decode($jsonRpcRequestAsync->run()->wait()->getBody(), true);

        if (isset($response['error'])) {
            throw new \LogicException($response['error']['message'], $response['error']['code']);
        }

        return view('page', compact('page'));
    }
}
