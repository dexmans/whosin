@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="section">

{{--       <div class="row">
        <div class="col s10 offset-s1">
          Looking at week: {{ $dateNav['meta']['current_week'] }} - {{ reset($dateNav['dates'])['date'] }} / {{ end($dateNav['dates'])['date'] }}
        </div>
      </div> --}}

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
              <th>
                Week {{ $dateNav['meta']['week'] }}<br>
                {{ $dateNav['meta']['year'] }}
              </th>
              @foreach ($dateNav['dates'] as $date)
                <th class="@if ($date['date'] == $dateNav['meta']['today'])light-green lighten-4 @elseif ($date['is_weekend']) grey lighten-3 @endif">
                  {{ $date['local_day'] }}<br>
                  {{ $date['day'] }} {{ $date['local_month_short'] }}
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
                      @component('components.date-entry', [
                        'entryUser' => $user,
                        'entryDate' => $userDate,
                      ])
                      @endcomponent
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
