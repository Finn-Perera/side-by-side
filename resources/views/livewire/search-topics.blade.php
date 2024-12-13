<div class="container mx-auto px-4 py-8 flex flex-col items-center">
    <form wire:submit="search" class="flex flex-col flex-auto items-center mb-6">
        <input type="text" wire:model="query" placeholder="Search a topic..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">

        <button type="submit" class= "mt-2 mr-4 text-gray-600 hover:text-blue-500 border border-gray-300 rounded-lg position">
            Search posts
        </button>
    </form>

    <div class="w-full max-w-6xl grid grid-cols-2 gap-8">
            @foreach($topics as $topic)
                <a href="{{ route('topics.show', $topic) }}" wire:navigate class="flex justify-center">
                    <div class="bg-white shadow-lg rounded-lg p-6 w-full">
                        <h2 class="text-2xl font-bold mb-4 text-center">{{ $topic->title }}</h2>
                        <div class="h-64 bg-amber-100 flex items-center justify-center text-gray-400">
                            Image Placeholder
                        </div>
                        <div class="mt-4 space-y-2">
                            <p>{{ $topic->description }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>



        <div class="mt-8 flex flex-col items-center">
            <div class="mb-2 text-gray-600">
                {{ $topics->firstItem() }} - {{ $topics->lastItem() }} of {{ $topics->total() }} results
            </div>
            <div class="flex space-x-2">
                @if ($topics->onFirstPage())
                    <span class="px-4 py-2 text-gray-400 border rounded">Previous</span>
                @else
                    <a href="{{ $topics->previousPageUrl() }}" wire:navigate class="px-4 py-2 bg-blue-500 rounded hover:bg-orange-600">Previous</a>
                @endif

                @if ($topics->hasMorePages())
                    <a href="{{ $topics->nextPageUrl() }}" wire:navigate class="px-4 py-2 bg-orange-500 rounded hover:bg-orange-600">Next</a>
                @else
                    <span class="px-4 py-2 text-gray-400 cursor-not-allowed border rounded">Next</span>
                @endif
            </div>
        </div>

</div>

