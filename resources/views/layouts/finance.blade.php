@extends('layouts.admin')

@section('content-header')
    <div role="tablist"
         class="mt-6 tabs ">
            <a role="tab"
             href="{{ route('admin.finance.abandoned-cart.index') }}"
               wire:navigate
               class="tab  {{  request()->routeIs('admin.finance.abandoned-cart.index')
                    ? '  font-semibold text-primary border-b-2 border-primary dark:border-primary dark:text-primary'
                    : '' }}">السلات المتروكة</a>
        <a role="tab"
           href="{{ route('admin.finance.orders.index') }}"
           wire:navigate
           class="tab  {{  request()->routeIs('admin.finance.orders.index')
                    ? '  font-semibold text-primary border-b-2 border-primary dark:border-primary dark:text-primary'
                    : '' }}">الطلبات</a>
        <a role="tab"
           href="{{ route('admin.finance.payments.index') }}"
           wire:navigate
           class="tab  {{  request()->routeIs('admin.finance.payments.index')
                    ? '  font-semibold text-primary border-b-2 border-primary dark:border-primary dark:text-primary'
                    : '' }}">المدفوعات</a>
    </div>
@endsection
