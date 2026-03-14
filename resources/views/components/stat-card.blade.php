@props(['title', 'value', 'icon', 'trend' => null, 'trendValue' => null, 'color' => 'sogan'])

<div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-{{ $color }} hover:shadow-lg transition-all duration-300">
    <div class="flex items-center justify-between mb-4">
        <div class="w-12 h-12 rounded-lg bg-{{ $color }}/10 flex items-center justify-center">
            <i class="fas {{ $icon }} text-2xl text-{{ $color }}"></i>
        </div>
        @if($trend)
        <span class="text-sm {{ $trend === 'up' ? 'text-green-600' : 'text-red-600' }}">
            <i class="fas fa-{{ $trend === 'up' ? 'arrow-up' : 'arrow-down' }} mr-1"></i>
            {{ $trendValue }}
        </span>
        @endif
    </div>

    <h3 class="text-gray-600 text-sm mb-1">{{ $title }}</h3>
    <p class="text-3xl font-bold text-sogan">{{ $value }}</p>
</div>