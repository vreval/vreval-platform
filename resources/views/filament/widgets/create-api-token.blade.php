<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex flex-col space-y-4">
            @if(!$this->plainTextToken)
                <p>To access any resource via the REST API, you first need to create an API token.</p>
                <form wire:submit.prevent="createToken" class="my-auto">
                    <x-filament::button color="gray" labeled-from="sm" tag="button" type="submit">
                        Create API Token
                    </x-filament::button>
                </form>
            @else
                <p class="text-danger-600 font-bold">This token will be shown once only. Be sure to keep a copy of it somewhere else.</p>
                <p class="font-mono">{{ $this->plainTextToken }}</p>
            @endif
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
