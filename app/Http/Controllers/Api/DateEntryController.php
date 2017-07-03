<?php

namespace App\Http\Controllers\Api;

use App\Helpers\DateHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\DateEntryRequest;
use App\Models\DateEntry;
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->dateEntriesRepository->setRepoParameters(request()->all());

        $entries = $this->dateEntriesRepository->getBuilder()->paginate();

        return response()->json($entries);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  DateEntryRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(DateEntryRequest $request)
    {
        $entry = app(DateEntry::class);

        $entry->fill($request->all());
        $entry->save();

        return request()->json();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $entry = $this->dateEntriesRepository->find($id);
        if (! $entry) {
            abort(404);
        }

        return request()->json($entry);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  DateEntryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DateEntryRequest $request, $id)
    {
        $entry = $this->dateEntriesRepository->find($id);
        if (! $entry) {
            abort(404);
        }

        $entry->fill($request->all());
        $entry->save();

        return request()->json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $entry = $this->dateEntriesRepository->find($id);
        if (! $entry) {
            abort(404);
        }

        $entry->delete();

        return request()->json();
    }
}
