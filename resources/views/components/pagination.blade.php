@if ($paginator->hasPages())
<div class="flex items-center justify-between bg-base-200 border border-base-300 rounded-lg px-4 py-2 mt-4">
    <div class="text-sm">
        @php
        $from = ($paginator->currentPage() - 1) * $paginator->perPage() + 1;
        $to = min($paginator->currentPage() * $paginator->perPage(), $paginator->total());
        @endphp
        Mostrando {{ $from }} - {{ $to }} de {{ $paginator->total() }} resultados
    </div>
    <nav>
        <div class="join">
            {{-- Botón Anterior --}}
            @if ($paginator->onFirstPage())
            <button class="btn btn-sm btn-disabled join-item font-medium">Anterior</button>
            @else
            <a href="{{ $paginator->previousPageUrl() }}" class="btn btn-sm join-item font-medium">Anterior</a>
            @endif

            {{-- Números de página --}}
            @foreach ($elements as $element)
            @if (is_string($element))
            <button class="btn btn-sm btn-disabled join-item font-medium">{{ $element }}</button>
            @endif
            @if (is_array($element))
            @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
            <button class="btn btn-sm btn-active join-item font-medium">{{ $page }}</button>
            @else
            <a href="{{ $url }}" class="btn btn-sm join-item font-medium">{{ $page }}</a>
            @endif
            @endforeach
            @endif
            @endforeach

            {{-- Botón Siguiente --}}
            @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="btn btn-sm join-item font-medium">Siguiente</a>
            @else
            <button class="btn btn-sm btn-disabled join-item font-medium">Siguiente</button>
            @endif
        </div>
    </nav>
</div>
@endif