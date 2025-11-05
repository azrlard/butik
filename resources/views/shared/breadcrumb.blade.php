{{-- Breadcrumb Component --}}
@php
    $breadcrumbs = $breadcrumbs ?? [];
    $currentPage = $currentPage ?? '';
@endphp

@if(count($breadcrumbs) > 0 || $currentPage)
<div class="bg-gray-50 py-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2">
                {{-- Home breadcrumb --}}
                <li>
                    <a href="/" class="text-gray-500 hover:text-indigo-600 transition-colors">Home</a>
                </li>

                {{-- Dynamic breadcrumbs --}}
                @foreach($breadcrumbs as $breadcrumb)
                    <li class="flex items-center">
                        <svg class="w-4 h-4 text-gray-400 mx-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        @if(isset($breadcrumb['url']))
                            <a href="{{ $breadcrumb['url'] }}" class="text-gray-500 hover:text-indigo-600 transition-colors">{{ $breadcrumb['label'] }}</a>
                        @else
                            <span class="text-gray-900">{{ $breadcrumb['label'] }}</span>
                        @endif
                    </li>
                @endforeach

                {{-- Current page --}}
                @if($currentPage)
                    <li class="flex items-center">
                        <svg class="w-4 h-4 text-gray-400 mx-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-gray-900">{{ $currentPage }}</span>
                    </li>
                @endif
            </ol>
        </nav>
    </div>
</div>
@endif