<div id="entry-{{ $entryUser->id }}-{{ $entryDate['date'] }}">
  @set('entry', $entryUser->entries->get($entryDate['date']))
  @if ($entry)
    @if (auth()->user()->id == $entryUser->id)
      <a class="tooltipped" href="#entry-{{ $entryUser->id }}-{{ $entryDate['date'] }}-modal" data-position="bottom" data-delay="50" data-html="true" data-tooltip="@lang('date-entry.states.' . $entry->state, ['time' => $entry->entry_time])@if ($entry->comments) <br><br>{!! nl2br($entry->comments) !!}@endif">
        @include('partials.date-entry-state', ['state' => $entry->state])
      </a>
    @else
      <span class="tooltipped" data-position="bottom" data-delay="50" data-html="true"  data-tooltip="@lang('date-entry.states.' . $entry->state, ['time' => $entry->entry_time])@if ($entry->comments) <br><br>{!! nl2br($entry->comments) !!}@endif">
        @include('partials.date-entry-state', ['state' => $entry->state])
      </span>
    @endif
  @else
    @if (auth()->user()->id == $entryUser->id)
      <a class="btn-floating waves-effect waves-light blue tooltipped" href="#entry-{{ $entryUser->id }}-{{ $entryDate['date'] }}-modal" data-position="bottom" data-delay="50" data-tooltip="Add entry">
        <i class="material-icons">add</i>
      </a>
    @else
      -
    @endif
  @endif

  {{ $slot }}
</div>

{{-- @todo move to vue --}}
@if (auth()->user()->id == $entryUser->id)
  <div id="entry-{{ $entryUser->id }}-{{ $entryDate['date'] }}-modal" class="modal modal-fixed-footer">
    @if ($entry)
      <form method="POST" action="{{ route('date-entries.update', $entry->id) }}">
      {{ method_field('PUT') }}
    @else
      <form method="POST" action="{{ route('date-entries.store') }} ">
    @endif
      {{ csrf_field() }}
      <input type="hidden" name="modal" value="entry-{{ $entryUser->id }}-{{ $entryDate['date'] }}-modal">
      <input type="hidden" name="entry_date" value="{{ $entryDate['date'] }}">
      <div class="modal-content">
        <h4>{{ $entryDate['local_day'] }}, {{ $entryDate['day'] }} {{ $entryDate['local_month'] }} {{ $entryDate['year'] }}</h4>

        @if ($errors && old('modal') == "entry-" . $entryUser->id . "-" . $entryDate['date'] . "-modal")
          @foreach ($errors->all() as $error)
            <p class="red">{{ $error }}</p>
          @endforeach
        @endif

        <p>Set attendence for</p>
        <div class="row">
          <div class="input-field col s12">
            @foreach (\App\Models\DateEntry::getStates() as $state)
              <p>
                <input class="with-gap" type="radio" name="state" value="{{ $state }}" id="entry-{{ $entryUser->id }}-{{ $entryDate['date'] }}-state-{{ $state }}" @if ((old('modal') == "entry-" . $entryUser->id . "-" . $entryDate['date'] . "-modal" && old('state') == $state) || ($entry && $entry->state == $state)) checked="checked" @endif/>
                <label for="entry-{{ $entryUser->id }}-{{ $entryDate['date'] }}-state-{{ $state }}">
                  @include('partials.date-entry-state', ['state' => $state, 'class' => 'tiny'])
                  @lang('date-entry.states.' . $state, ['time' => 'xx:xx'])
                </label>
              </p>
            @endforeach
          </div>
        </div>

        <div class="row">
          <div class="input-field col s12">
            <input type="time" class="timepicker" name="entry_time" @if (old('modal') == "entry-" . $entryUser->id . "-" . $entryDate['date'] . "-modal" && old('entry_time')) value="{{ old('entry_time') }}" @elseif ($entry && $entry->entry_time) value="{{ $entry->entry_time }}"@endif @if (!$entry or ($entry && !in_array($entry->state, \App\Models\DateEntry::getTimeRelatedStates()))) disabled="disabled" @endif />
          </div>
        </div>

        <div class="row">
          <div class="input-field col s12">
            <textarea id="entry-{{ $entryUser->id }}-{{ $entryDate['date'] }}-comments" name="comments" class="materialize-textarea">@if (old('modal') == "entry-" . $entryUser->id . "-" . $entryDate['date'] . "-modal"){{ old('comments') }}@elseif ($entry){{ $entry->comments }}@endif</textarea>
            <label for="entry-{{ $entryUser->id }}-{{ $entryDate['date'] }}-comments">Textarea</label>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        {{-- @if ($entry)
          <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
        @endif --}}
        <button type="submit" class="modal-action waves-effect waves-green btn-flat">Save</button>
        <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat">Cancel</a>
      </div>
    </form>
  </div>

  @if ($errors && old('modal') == "entry-" . $entryUser->id . "-" . $entryDate['date'] . "-modal")
    @section('js-post')
      @parent
      <script type="text/javascript">
        $(document).ready(function(){
          $('#{{ old('modal') }}').modal('open');
        });
      </script>
    @endsection
  @endif

  @section('js-post')
    @parent

    <script type="text/javascript">
      $('#entry-{{ $entryUser->id }}-{{ $entryDate['date'] }}-modal input[name="state"]').change(function(e) {
        var $this = $(this);
        var $timeElm = $('#entry-{{ $entryUser->id }}-{{ $entryDate['date'] }}-modal input[name="entry_time"]');
        if ($.inArray($this.val(), {!! json_encode(\App\Models\DateEntry::getTimeRelatedStates()) !!})) {
          $timeElm.attr('disabled', true);
        } else {
          $timeElm.attr('disabled', false);
        }
      });
    </script>
  @endsection
@endif
