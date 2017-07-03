@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="section">

      <div class="row">
        <div class="col s10 offset-s1">
          Looking at week: {{ $dateNav['meta']['current_week'] }} - {{ reset($dateNav['dates'])['date'] }} / {{ end($dateNav['dates'])['date'] }}
        </div>
      </div>

      <div class="row">
        <div class="col s1 offset-s1">
          <a class="waves-effect waves-light btn" href="{{ $dateNav['nav']['previous'] }}"> <i class="material-icons">chevron_left</i> </a>
        </div>
        <div class="col s8 center-align">
          <a class="waves-effect waves-light btn" href="{{ $dateNav['nav']['current'] }}"> This week </a>
        </div>
        <div class="col s1">
            <a class="waves-effect waves-light btn" href="{{ $dateNav['nav']['next'] }}"> <i class="material-icons">chevron_right</i> </a>
        </div>
      </div>

      <div class="row">
        <div class="col s10 offset-s1">

          <table class="centered bordered highlight">
            <thead>
              <th>&nbsp;</th>
              @foreach ($dateNav['dates'] as $date)
                <th class="@if ($date['date'] == $dateNav['meta']['today'])light-green lighten-4 @elseif ($date['is_weekend']) grey lighten-3 @endif">
                  {{ $date['day'] }}<br>
                  {{ $date['date_formatted'] }}
                </th>
              @endforeach
            </thead>
            <tbody>
              @foreach ($users as $user)
                <tr>
                  <td>
                    {{ $user->full_name }}
                  </td>
                  @foreach ($dateNav['dates'] as $userDate)
                    <td class="centered @if ($userDate['date'] == $dateNav['meta']['today']) light-green lighten-4 @elseif ($userDate['is_weekend']) grey lighten-3 @endif">
                      {{-- @todo move to partial/component --}}
                      @if ($user->entries->has($userDate['date']))
                        @set('entry', $user->entries->get($userDate['date']))
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
