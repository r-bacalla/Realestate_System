@props(['errors'])

@if ($errors && $errors->any())
    <div {{ $attributes->merge(['class' => 'rounded-3xl border border-red-200 bg-red-50 p-4 text-sm text-red-700']) }}>
        <div class="font-semibold">Please fix the following errors:</div>
        <ul class="mt-2 list-disc list-inside space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
