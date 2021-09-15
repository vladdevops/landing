<?php

namespace App\Http\Controllers;

use App\Services\JsonRpcRequestAsync;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class AdminController extends Controller
{
    protected $perPage = 25;

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @var $page null|string
     *
     */
    public function index()
    {
        request()->validate([
            'page' => 'integer|min:1',
        ]);

        $jsonRpcRequestAsync = new JsonRpcRequestAsync('getStatistic', [
            'page' => request('page', 1),
            'take' => $this->perPage,
        ]);

        $response = json_decode($jsonRpcRequestAsync->run()->wait()->getBody(), true);

        if (isset($response['error'])) {
            throw new \LogicException($response['error']['message'], $response['error']['code']);
        }

        $paginator = new LengthAwarePaginator(collect($response['result']['rows']), $response['result']['count'], $response['result']['take'], $response['result']['page']);

        $paginator->setPath(route('admin.activity'));

        Paginator::useBootstrapThree();

        return view('admin.activity', compact('paginator'));
    }
}
