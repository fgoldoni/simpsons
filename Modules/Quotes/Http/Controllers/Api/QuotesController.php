<?php

namespace Modules\Quotes\Http\Controllers\Api;

use App\Repositories\Criteria\EagerLoad;
use App\Repositories\Criteria\OrderBy;
use App\Repositories\Criteria\Where;
use App\Responsable\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use JustSteveKing\StatusCode\Http;
use Modules\Quotes\Repositories\Contracts\QuotesRepository;

class QuotesController extends Controller
{
    public function __construct(
        private readonly QuotesRepository $quotesRepository,
    ) {
    }
    public function index(Request $request)
    {
        try {
            $quotes = $this->quotesRepository->withCriteria([
                new EagerLoad(['user']),
                new Where('quotes.user_id', auth()->guard('api')->user()->id),
                new OrderBy('quotes.id', 'desc'),
            ])->paginate()
                ->withQueryString()
                ->through(fn ($quote) => [
                    'id' => $quote->id,
                    'quote' => $quote->quote,
                    'character' => $quote->character,
                    'image' => $quote->image,
                    'characterDirection' => $quote->characterDirection,
                    'user_id' => $quote->user_id,
                ]);

            return new JsonResponse(
                data: [
                    'quotes' => $quotes,
                ]
            );

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
        return view('quotes::create');
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        return view('quotes::show');
    }


    public function edit($id)
    {
        return view('quotes::edit');
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
