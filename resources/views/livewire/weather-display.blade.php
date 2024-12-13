<div class="flex items-center space-x-2 p-2 bg-gray-50 dark:bg-gray-800 rounded-lg shadow-md">
    @if ($weather)
        <p class="text-lg font-semibold text-gray-800 dark:text-white">
            <b>{{$temperature}}°C</b>
        </p>
        <img src="{{ $icon }}" alt="{{ $weather }}" class="w-12 h-12 rounded-full object-cover">
    @else
        <p class="text-gray-500 dark:text-gray-300">Weather data not available</p>
    @endif
</div>
