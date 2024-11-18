<div class="w-full max-w-2xl min-h-[calc(100vh-220px)] flex flex-col
justify-between">

    @if(count($cartItems)>0 )

        <div class="overflow-y-auto space-y-3">
            @foreach($cartItems as $item)
                <livewire:client.components.cart-row :$item :key="$item->id"/>
            @endforeach
        </div>

        <button class="btn btn-primary w-full mt-6">
            إتمام الشراء
        </button>
    @else
        <div class="flex flex-col items-center justify-center h-full gap-2">
                لا يوجد منتجات في السلة
                <button class="btn btn-primary w-full mt-6"
                href="{{route('client.courses.index')}}"
                        wire:navigate
                >
                        استكشف الكورسات
                </button>
        </div>
    @endif
</div>
