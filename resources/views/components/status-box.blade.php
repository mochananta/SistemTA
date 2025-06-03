@props(['color' => 'yellow', 'icon' => 'fas fa-info-circle', 'title', 'message'])

<div class="bg-{{ $color }}-50 dark:bg-{{ $color }}-900 p-5 rounded-lg border border-{{ $color }}-200 dark:border-{{ $color }}-700 shadow-md">
    <h3 class="text-{{ $color }}-700 dark:text-{{ $color }}-300 text-2xl font-bold flex justify-center items-center gap-2">
        <i class="{{ $icon }}"></i> {{ $title }}
    </h3>
    <p class="mt-2 text-sm text-gray-800 dark:text-gray-200">
        {{ $message }}
    </p>
</div>
