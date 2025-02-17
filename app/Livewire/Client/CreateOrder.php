<?php

namespace App\Livewire\Client;

use App\Livewire\Forms\OrderForm;
use App\Models\Cart;
use App\Models\Enrollment;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Mary\Traits\Toast;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class CreateOrder extends Component
{
    use Toast;

    public OrderForm $form;
    public $cartItems = [];
    public string $title = 'إتمام الدفع';
    public string $logo = <<<'EOT'
<svg class="w-12 h-12 text-gray-800  dark:text-white "
                                viewBox="0 0 30 31"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M24.0523 7.26952H7.20752L5.76826 4.68973C5.60672 4.40016 5.3011 4.2207 4.96952 4.2207H3.14023C2.63509 4.2207 2.22559 4.6302 2.22559 5.13535C2.22559 5.64049 2.63509 6.04999 3.14023 6.04999H4.43244L5.85281 8.59593L9.12854 15.8438L9.1319 15.8512L9.42042 16.4896L6.13156 19.9978C5.89508 20.25 5.82106 20.614 5.94024 20.9386C6.05943 21.2632 6.35145 21.4928 6.69497 21.532L9.69273 21.8746C13.4424 22.3032 17.2286 22.3032 20.9783 21.8746L23.976 21.532C24.4779 21.4747 24.8383 21.0213 24.7809 20.5195C24.7235 20.0176 24.2702 19.6572 23.7683 19.7146L20.7706 20.0572C17.1589 20.4699 13.5121 20.4699 9.90044 20.0572L8.71077 19.9212L11.1247 17.3464C11.148 17.3215 11.1697 17.2956 11.1897 17.2689L12.1078 17.3884C13.3943 17.5558 14.6948 17.5886 15.9881 17.4863C19.0045 17.2477 21.8002 15.8124 23.752 13.5002L24.457 12.665C24.4806 12.637 24.5026 12.6075 24.5227 12.5768L25.8366 10.5745C26.7679 9.1553 25.7498 7.26952 24.0523 7.26952ZM11.2577 15.4331C11.056 15.4068 10.8821 15.2787 10.7971 15.094L10.7955 15.0905L8.08752 9.0988H24.0523C24.2948 9.0988 24.4403 9.3682 24.3072 9.57095L23.0236 11.5272L22.3541 12.3202C20.7175 14.2591 18.3732 15.4627 15.8438 15.6627C14.6773 15.755 13.5043 15.7254 12.3438 15.5744L11.2577 15.4331Z"
                                    fill="currentColor" />
                                <path
                                    d="M8.62809 23.4282C7.61781 23.4282 6.79881 24.2472 6.79881 25.2575C6.79881 26.2678 7.61781 27.0868 8.62809 27.0868C9.63838 27.0868 10.4574 26.2678 10.4574 25.2575C10.4574 24.2472 9.63838 23.4282 8.62809 23.4282Z"
                                    fill="currentColor" />
                                <path
                                    d="M20.2136 25.2575C20.2136 24.2472 21.0326 23.4282 22.0429 23.4282C23.0532 23.4282 23.8722 24.2472 23.8722 25.2575C23.8722 26.2678 23.0532 27.0868 22.0429 27.0868C21.0326 27.0868 20.2136 26.2678 20.2136 25.2575Z"
                                    fill="currentColor" />
                            </svg>
EOT;
    public $paymentData;

    public function mount()
    {
        $this->cartItems = Cart::where('user_id', auth()->id())->with('course')->get();
        $this->form->setCartItems($this->cartItems->map(function ($item) {
            return [
                'course_id' => $item->course_id,
                'price' => $item->course->price,
                'discount' => $item->course->discount,
                'net_price' => $item->course->net_price,
            ];
        })->toArray());


        $this->paymentData = [
            'cartItems' => $this->cartItems->map(function ($item) {
                return [
                    'name' => $item->course->title,
                    'quantity' => 1,
                    'price' => $item->course->net_price,
                ];
            })->toArray(),
            'cartTotal' => collect($this->cartItems)->sum('course.net_price'),
            'shipping' => 0,
            'customer' => [
                'first_name' => auth()->user()->first_name,
                'last_name' => auth()->user()->last_name,
                'phone' => auth()->user()->phone,
                'address' => auth()->user()->address,
            ],
            'currency' => 'EGP',
            'payLoad' => [],
            'sendEmail' => true,
            'sendSMS' => false,
        ];
    }

    public function createOrder()
    {
        // handle payment and order creation here
        DB::beginTransaction();
        try {
            $this->form->payment_status = 'paid';
            $this->form->status = 'completed';
            $order = $this->form->createOrder(auth()->id());
            if ($order) {
                // Clear the cart
                Cart::where('user_id', auth()->id())->delete();
                // implement add courses (order items) to enrollments
                Enrollment::insert($this->cartItems->map(function ($item) use ($order) {
                    return [
                        'user_id' => auth()->id(),
                        'course_id' => $item->course_id,
                        'order_id' => $order->id
                    ];
                })->toArray());
                DB::commit();

                // Redirect to success page or payment gateway
                $this->success('تم إنشاء الطلب بنجاح!');
//                $this->redirect(route('user.profile', auth()->id()), navigate: true);
            }
        } catch (\Exception $e) {
            DB::rollback();
            $this->warning('فشل إنشاء الطلب. يرجى المحاولة مرة أخرى');
        }

//        session()->flash('error', 'Failed to create order. Please try again.');
//        return null;
    }

    public function render()
    {
        return view('livewire.client.create-order', [
            'cartItems' => $this->cartItems,
        ])->layout('layouts.client', ['title' => $this->title, 'logo' => $this->logo]);
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//    public function createInvoiceLink()
//    {
//        // Example payment data; you can pull this from the request
//        $fawaterakBaseURL=  "https://staging.fawaterk.com";
////        $fawaterakBaseURL = config('app.environment') === 'dev'
////            ? 'https://staging.fawaterk.com'
////            : 'https://app.fawaterk.com';
//
//        $response = Http::withHeaders([
//            'Content-Type' => 'application/json',
//            'Authorization' => 'Bearer 17fd75bc99a68940549a7c98c3c33f521a274f353c3714eb46', // todo: Replace with your actual token
//        ])->post("{$fawaterakBaseURL}/api/v2/createInvoiceLink", $this->paymentData);
//
//        // Log the response
//        \Log::info('PaymentRes: ' . $response->body());
//
//
////        if ($response->body()['status'] === 'success') {
//            $responseBody = $response->json();
////            dd($responseBody['data']);
//            return redirect()->away($responseBody['data']['url']);
////        } else {
////            return response()->json(['error' => 'Failed to create invoice link'], $response->status());
////        }
//    }
    public function createInvoiceLink()
    {
        $fawaterakBaseURL = "https://staging.fawaterk.com";

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer 17fd75bc99a68940549a7c98c3c33f521a274f353c3714eb46',
        ])->post("{$fawaterakBaseURL}/api/v2/createInvoiceLink", $this->paymentData);

//        dd($response->body());
//        $responseData = json_decode($response->body() );
//
//        if (isset($responseData['data']['url'])) {
        $this->createOrder();

        return redirect()->away('https://staging.fawaterk.com/lk/28171');
    }

//        $this->warning('حدث خطأ في عملية الدفع');
//        return null;
//    }

}
