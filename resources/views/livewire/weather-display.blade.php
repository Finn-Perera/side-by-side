<div>
    @if ($weather)
        <p><b>{{$temperature}}°C</b></p>
        <img src="{{ $icon }}" alt="{{ $weather }}">
    @else
        <p>Weather data not available</p>
    @endif
   
</div>
