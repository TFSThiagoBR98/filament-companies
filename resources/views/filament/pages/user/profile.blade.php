<x-filament-panels::page>
    @php
        $components = \TFSThiagoBR98\FilamentTenant\FilamentCompanies::getProfileComponents();
    @endphp

    @foreach($components as $index => $component)
        @livewire($component)

        @if($loop->remaining)
            <x-filament-companies::section-border />
        @endif
    @endforeach
</x-filament-panels::page>
