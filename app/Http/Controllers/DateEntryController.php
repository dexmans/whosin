<?php

namespace App\Http\Controllers;

use App\Models\DateEntry;
use App\Http\Requests\DateEntryRequest;
use App\Repositories\DateEntriesRepository;
use Illuminate\Http\Request;

class DateEntryController extends Controller
{
    protected $dateEntriesRepository;

    /**
     * Create a new controller instance.
     *
     * @param  DateEntriesRepository $dateEntriesRepository
     * @return void
     */
    public function __construct(DateEntriesRepository $dateEntriesRepository)
    {
        $this->dateEntriesRepository = $dateEntriesRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  DateEntryRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(DateEntryRequest $request)
    {
        $entry = $this->dateEntriesRepository->makeModel();

        $entry->fill($request->all());
        $entry->save();

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  DateEntryRequest  $request
     * @param  DateEntry  $entry
     * @return \Illuminate\Http\Response
     */
    public function update(DateEntryRequest $request, DateEntry $entry)
    {
        $entry->fill($request->all());
        $entry->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DateEntry  $entry
     * @return \Illuminate\Http\Response
     */
    public function destroy(DateEntry $entry)
    {
        $entry->delete();

        return redirect()->back();
    }
}
