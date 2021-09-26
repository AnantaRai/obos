<div class="mx-4 px-4 relative w-3/4 text-right">
    <input
    type="text"
    class="h-8 w-1/2"
    placeholder="Search for products"
    wire:model="query"
    wire:keydown.escape="clear"
    wire:keydown.tab="clear"
    >
    @if(!empty($query))
    <div class="fixed top-0 right-0 bottom-0 left-0" wire:click="clear">
    </div>
        <div class="absolute p-4 z-10 right-0 list-group bg-white w-2/4 rounded-t-none shadow-lg">
            @if (!empty($products))
                @foreach ($products as $product)
                    <div class="hover:bg-gray-100">
                        <a href="{{ route('shop.show', $product['slug']) }}" class="list-item flex justify-between items-center">
                            <img src="{{ asset('img/products/'.$product['slug'].'.jpg') }}" alt="{{ $product['name'] }}" class="rounded-lg w-20">
                            <p>{{ $product['name'] }}</p>
                        </a>
                    </div>
                    <hr>
                @endforeach
            @else
                <div class="list-item">
                    <p class="text-center">No such products!</p>
                </div>
            @endif
        </div>
    @endif

</div>