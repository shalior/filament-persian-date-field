@once
    @push('scripts')
        @if(config('filament-persian-date-field.cdn.jQuery'))
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        @endif
        @if(config('filament-persian-date-field.cdn.persian-datepicker'))
            <script src="//unpkg.com/persian-date@latest/dist/persian-date.min.js"></script>
            <script src="//unpkg.com/persian-datepicker@latest/dist/js/persian-datepicker.min.js"></script>
        @endif
    @endpush
@endonce

<x-forms::field-wrapper
    :id="$getId()"
    :label="$getLabel()"
    :label-sr-only="$isLabelHidden()"
    :helper-text="$getHelperText()"
    :hint="$getHint()"
    :required="$isRequired()"
    :state-path="$getStatePath()"
>
    <div
        wire:ignore
        wire:model="{{ $getStatePath() }}"
        x-init="
        $('#{{\Illuminate\Support\Str::replace('.' , '\\\.' , $getId() )}}_view').pDatepicker({
        autoClose: true,
        initialValue: {{$getDefaultState() ? 'true' : 'false'}},
        viewMode: 'day',
        altFormat: `YYYY/MM/DD`,
        format: `YYYY/MM/DD`,
        altField: '#{{$getId()}}',
        altFieldFormatter: function (unix) {
            let date = new Date(unix);
            const formatedDate = date.getFullYear().toString() + '-'
            + ((date.getMonth()+1).toString().length === 1 ? '0' + (date.getMonth()+1).toString() : (date.getMonth()+1).toString() )
            + '-'
            + (date.getDate().toString().length === 1 ? '0' + date.getDate().toString() : date.getDate().toString());

            $dispatch('input' , formatedDate); // Y-m-d
            return formatedDate;
        }
       });
        "
        {{ $attributes->class([
           'bg-white relative w-full border pl-3 pr-10 py-2 text-left cursor-default rounded-lg shadow-sm focus-within:border-primary-600 focus-within:ring-1 focus-within:ring-inset focus-within:ring-primary-600',
           'border-gray-300' => ! $errors->has($getStatePath()),
           'border-danger-600 motion-safe:animate-shake' => $errors->has($getStatePath()),
           'text-gray-500' => $isDisabled(),
        ]) }}

    >
        <input
            readonly
            id="{{$getId()}}_view"
            autofocus autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"
            class="text-left w-full h-full p-0 placeholder-gray-400 border-0 focus:placeholder-gray-500 focus:ring-0 focus:outline-none"
            value="{{$getDefaultState()}}" type="text"/>

        <x-jet-input id="{{$getId()}}" class="block mt-1 w-full hidden" type="hidden" name="{{$getId()}}"/>

        <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </span>
    </div>
</x-forms::field-wrapper>
