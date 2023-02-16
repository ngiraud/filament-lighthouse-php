<x-filament::page
    :widget-data="['record' => $record]"
    :class="\Illuminate\Support\Arr::toCssClasses([
        'filament-resources-view-record-page',
        'filament-resources-' . str_replace('/', '-', $this->getResource()::getSlug()),
        'filament-resources-record-' . $record->getKey(),
    ])"
>
    <div class="mt-10 custom h-screen">
        <iframe src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url('lighthouse-report.html') }}"
                class="w-full h-full border-none"
        ></iframe>
    </div>
</x-filament::page>
