@if ($state == \App\Models\DateEntry::STATE_YES)
<i class="material-icons @if (isset($class)) {{ $class }} @endif green-text">done</i>
@elseif ($state == \App\Models\DateEntry::STATE_NO)
<i class="material-icons @if (isset($class)) {{ $class }} @endif red-text">clear</i>
@elseif ($state == \App\Models\DateEntry::STATE_MAYBE)
<i class="material-icons @if (isset($class)) {{ $class }} @endif blue-text">help_outline</i>
@elseif ($state == \App\Models\DateEntry::STATE_TIME_FROM)
<i class="material-icons @if (isset($class)) {{ $class }} @endif">rotate_left</i>
@elseif ($state == \App\Models\DateEntry::STATE_TIME_UNTIL)
<i class="material-icons @if (isset($class)) {{ $class }} @endif">rotate_right</i>
@endif
{{-- <i class="material-icons">schedule</i> --}}
