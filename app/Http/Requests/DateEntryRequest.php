<?php

namespace App\Http\Requests;

use App\Models\DateEntry;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DateEntryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user  = auth()->user();
        $entry = $this->date_entry ?? new DateEntry;

        switch ($this->method()) {
            case 'PUT':
            case 'PATCH':
                return $entry->user_id == $user->id;
                break;

            default:
                return auth()->check();
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user  = auth()->user();
        $entry = $this->date_entry ?? new DateEntry;

        switch ($this->method()) {
            case 'POST':
                return [
                    'entry_date' => [
                        'required',
                        'date_format:Y-m-d',
                        Rule::unique($entry->getTable())->where(function ($query) use ($user) {
                            $query->where('user_id', $user->id);
                        }),
                    ],
                    'state'      => [
                        'required',
                        Rule::in(DateEntry::getStates()),
                    ],
                    'entry_time' => [
                        'required_if:state,' . implode(',', DateEntry::getTimeRelatedStates()),
                        'date_format:H:i',
                    ],
                    'comments'   => [
                        'max:65534', // just in case
                    ],
                ];
                break;

            case 'PUT':
            case 'PATCH':
                return [
                    'entry_date' => [
                        'required',
                        'date_format:Y-m-d',
                        Rule::unique($entry->getTable())->where(function ($query) use ($user) {
                            $query->where('user_id', $user->id);
                        })->ignore($entry->id),
                    ],
                    'state'      => [
                        'required',
                        Rule::in(DateEntry::getStates()),
                    ],
                    'entry_time' => [
                        'required_if:state,' . implode(',', DateEntry::getTimeRelatedStates()),
                        'date_format:H:i',
                    ],
                    'comments'   => [
                        'max:65534', // just in case
                    ],
                ];
                break;

            default:
                return [];
                break;
        }
    }
}
