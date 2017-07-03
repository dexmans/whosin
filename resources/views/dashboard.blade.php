@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="section">

      <div class="row">
        <div class="col s10 offset-s1">
          Looking at week: {{ $week }} - {{ reset($dates) }} / {{ end($dates) }}


        </div>
      </div>

      <div class="row">
        <div class="col s10 offset-s1">

          <table class="bordered highlight">
            <thead>
              <th>&nbsp;</th>
              @foreach ($dates as $date)
                <th>{{ $date }}</th>
              @endforeach
            </thead>
            <tbody>
              @foreach ($users as $user)
                <tr>
                  <td>{{ $user->full_name }}</td>
                  @foreach ($dates as $userDate)
                    <td>
                      {{-- @todo move to partial/component --}}
                      @if ($user->entries->has($userDate))
                        @set('entry', $user->entries->get($userDate))
                        {{ $entry->state }}
                      @else
                        @if (auth()->user()->id == $user->id)
                          <a class="btn-floating waves-effect waves-light blue">
                            <i class="material-icons">add</i>
                          </a>
                        @else
                          <i class="material-icons">info_outline</i>
                        @endif
                      @endif
                    </td>
                  @endforeach
                </tr>
              @endforeach
            </tbody>
          </table>

        </div>
      </div>
    </div>
  </div>
@endsection
