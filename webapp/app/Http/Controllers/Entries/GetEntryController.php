<?php

namespace App\Http\Controllers\Entries;

use App\Http\Controllers\Controller;
use App\Services\Entries\EntryService;
use Illuminate\Http\Request;

class GetEntryController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, EntryService $service): array
    {
        $entries = $service->getEntries();
        return ['entries' => $entries];
    }
}