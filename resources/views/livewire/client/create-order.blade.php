<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class=" overflow-hidden shadow-sm
        sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
{{--                <h2 class="text-2xl font-bold mb-4">إنشاء طلب</h2>--}}

                @if (session()->has('message'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                        {{ session('message') }}
                    </div>
                @endif

                @if (session()->has('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="mb-8">
                    <h3 class="text-xl font-semibold mb-4">محتويات السلة</h3>
                    <div class="space-y-4">
                        @foreach($cartItems as $item)
                            <div class="flex justify-between items-center border-b pb-4">
                                <div>
                                    <h4 class="font-medium">{{ $item->course->title }}</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $item->course->sub_title }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-medium">{{ number_format($item->course->price, 2) }} EGP</p>
                                    @if($item->course->discount > 0)
                                        <p class="text-sm text-red-600">-{{
                                        number_format
                                        ($item->course->discount, 2) }}
                                            %</p>
                                    @endif
                                    <p class="font-bold">{{ number_format($item->course->net_price, 2) }} EGP</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mb-8">
                    <h3 class="text-xl font-semibold mb-4">ملخص الطلب</h3>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span>المجموع الفرعي:</span>
                            <span>{{ number_format($form->total_price, 2) }} EGP</span>
                        </div>
                        <div class="flex justify-between text-red-600">
                            <span>الخصم:</span>
                            <span>-{{ number_format($form->discount, 2) }}%</span>
                        </div>
                        <div class="flex justify-between font-bold text-lg">
                            <span>الإجمالي:</span>
                            <span>{{ number_format($form->net_price, 2) }} EGP</span>
                        </div>
                    </div>
                </div>

{{--                <div class="mb-8">--}}
{{--                    <h3 class="text-xl font-semibold mb-4">طريقة الدفع</h3>--}}
{{--                    <div class="space-y-4">--}}
{{--                        <label class="flex items-center ">--}}
{{--                            <input type="radio" wire:model="form.payment_method" value="credit_card" class="radio--}}
{{--                             radio-primary me-3">--}}
{{--                            <span>بطاقة ائتمان</span>--}}
{{--                        </label>--}}
{{--                        <label class="flex items-center ">--}}
{{--                            <input type="radio" wire:model="form.payment_method" value="bank_transfer"--}}
{{--                                   class="radio radio-primary me-3">--}}
{{--                            <span>تحويل بنكي</span>--}}
{{--                        </label>--}}
{{--                        <label class="flex items-center ">--}}
{{--                            <input type="radio" wire:model="form.payment_method" value="cash" class="radio--}}
{{--                            radio-primary me-3">--}}
{{--                            <span>نقداً</span>--}}
{{--                        </label>--}}
{{--                        @error('form.payment_method')--}}
{{--                            <span class="text-red-600 text-sm">{{ $message }}</span>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
{{--                </div>--}}

                <div class="flex justify-end" x-data="invoiceLink()">
                    <button wire:click="createInvoiceLink" class="btn btn-primary
                    text-white font-bold py-2 px-4 rounded">
                        تأكيد الطلب
                    </button>
{{--                    <button x-data="{ paymentData: $wire.paymentData }" @click="createInvoiceLink()" class="btn--}}
{{--                    btn-primary--}}
{{--                    text-white font-bold py-2 px-4 rounded">--}}
{{--                        تأكيد الطلب--}}
{{--                    </button>--}}
{{--                    <script>--}}
{{--                        function invoiceLink() {--}}
{{--                            return {--}}

{{--                                // this with--}}
{{--                                // your payment data--}}
{{--                                warning: '',--}}
{{--                                async createInvoiceLink() {--}}
{{--                                    console.log("paymentData", this.paymentData);--}}

{{--                                    const fawaterakBaseURL = "https://staging.fawaterk.com";--}}
{{--                                    const token = 'Bearer 17fd75bc99a68940549a7c98c3c33f521a274f353c3714eb46';--}}

{{--                                    try {--}}
{{--                                        const response = await fetch(`${fawaterakBaseURL}/api/v2/createInvoiceLink`, {--}}
{{--                                            method: 'POST',--}}
{{--                                            headers: {--}}
{{--                                                'Content-Type': 'application/json',--}}
{{--                                                'Authorization': token,--}}
{{--                                            },--}}
{{--                                            body: JSON.stringify(this.paymentData),--}}
{{--                                        });--}}
{{--                                        console.log("response", response);--}}

{{--                                        const responseData = await response.json();--}}
{{--                                        console.log("response", JSON.stringify(responseData));--}}
{{--                                        // const responseData = await response.json();--}}
{{--                                        console.log("responseData", responseData);--}}

{{--                                        if (responseData.data && responseData.data.url) {--}}
{{--                                            window.location.href = responseData.data.url;--}}
{{--                                        } else {--}}
{{--                                            this.warning = 'حدث خطأ في عملية الدفع';--}}
{{--                                        }--}}
{{--                                    } catch (error) {--}}
{{--                                        this.warning = 'حدث خطأ في عملية الدفع';--}}
{{--                                    }--}}
{{--                                }--}}
{{--                            };--}}
{{--                        }--}}
{{--                    </script>--}}

                </div>
            </div>
        </div>
    </div>
</div>
