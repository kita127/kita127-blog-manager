<?php

namespace App\Http\Controllers\Entries;

use App\Http\Requests\Entries\EntryRequest;
use App\Services\Entries\EntryService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GetAnEntryController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, EntryService $service): array
    {
        $entryId = $request->route('entryId');
        $entry = $service->getEntry($entryId);
        return $entry;
    }
}