<?php

namespace Modules\Simpsons\Http\Controllers\Api;

use App\Responsable\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use JustSteveKing\StatusCode\Http;
use Modules\Simpsons\Processes\Payload\SimpsonPayload;
use Modules\Simpsons\Processes\Process\SimpsonsProcess;

class SimpsonsController extends Controller
{
    public function __construct(
        private readonly SimpsonsProcess $process,
    ) {
    }

    public function index(Request $request)
    {
        try {
            return $this->process->handle(SimpsonPayload::make($request));
        } catch (\Exception $e) {
            return new JsonResponse(
                data: [
                    'message' => $e->getMessage(),
                ],
                status: Http::INTERNAL_SERVER_ERROR,
            );
        }
    }


    public function create()
    {
        return view('simpsons::create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('simpsons::show');
    }

    public function edit($id)
    {
        return view('simpsons::edit');
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
