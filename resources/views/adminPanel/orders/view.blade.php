@extends('adminPanel.layouts.app')
@section('adminContent')
<div >
    <div class="mb-6 flex flex-wrap items-center justify-center gap-4 lg:justify-end">
        <button type="button" class="btn btn-success gap-2">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
                <path
                    opacity="0.5"
                    d="M17 9.00195C19.175 9.01406 20.3529 9.11051 21.1213 9.8789C22 10.7576 22 12.1718 22 15.0002V16.0002C22 18.8286 22 20.2429 21.1213 21.1215C20.2426 22.0002 18.8284 22.0002 16 22.0002H8C5.17157 22.0002 3.75736 22.0002 2.87868 21.1215C2 20.2429 2 18.8286 2 16.0002L2 15.0002C2 12.1718 2 10.7576 2.87868 9.87889C3.64706 9.11051 4.82497 9.01406 7 9.00195"
                    stroke="currentColor"
                    stroke-width="1.5"
                    stroke-linecap="round"
                ></path>
                <path
                    d="M12 2L12 15M12 15L9 11.5M12 15L15 11.5"
                    stroke="currentColor"
                    stroke-width="1.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                ></path>
            </svg>
            Download
        </button>
    </div>
    <div class="panel">
        <div class="flex flex-wrap justify-between gap-4 px-4">
            <div class="text-2xl font-semibold uppercase">Invoice</div>
            <div class="shrink-0">
                <img src="{{ asset('web/assets/img/abv.png') }}" alt="image" class="w-14 ltr:ml-auto rtl:mr-auto" />
            </div>
        </div>
        <div class="px-4 ltr:text-right rtl:text-left">
            <div class="mt-6 space-y-1 text-white-dark">
                <div>13 Tetrick Road, Cypress Gardens, Florida, 33884, US</div>
                <div>vristo@gmail.com</div>
                <div>+1 (070) 123-4567</div>
            </div>
        </div>

        <hr class="my-6 border-[#e0e6ed] dark:border-[#1b2e4b]" />
        <div class="flex flex-col flex-wrap justify-between gap-6 lg:flex-row">
            <div class="flex-1">
                <div class="space-y-1 text-white-dark">
                    <div>Issue For:</div>
                    <div class="font-semibold text-black dark:text-white">John Doe</div>
                    <div>405 Mulberry Rd. Mc Grady, NC, 28649</div>
                    <div>redq@company.com</div>
                    <div>(128) 666 070</div>
                </div>
            </div>
            <div class="flex flex-col justify-between gap-6 sm:flex-row lg:w-2/3">
                <div class="xl:1/3 sm:w-1/2 lg:w-2/5">
                    <div class="mb-2 flex w-full items-center justify-between">
                        <div class="text-white-dark">Invoice :</div>
                        <div>#8701</div>
                    </div>
                    <div class="mb-2 flex w-full items-center justify-between">
                        <div class="text-white-dark">Issue Date :</div>
                        <div>13 Sep 2022</div>
                    </div>
                    <div class="mb-2 flex w-full items-center justify-between">
                        <div class="text-white-dark">Order ID :</div>
                        <div>#OD-85794</div>
                    </div>
                    <div class="flex w-full items-center justify-between">
                        <div class="text-white-dark">Shipment ID :</div>
                        <div>#SHP-8594</div>
                    </div>
                </div>
                <div class="xl:1/3 sm:w-1/2 lg:w-2/5">
                    <div class="mb-2 flex w-full items-center justify-between">
                        <div class="text-white-dark">Bank Name:</div>
                        <div class="whitespace-nowrap">Bank Of America</div>
                    </div>
                    <div class="mb-2 flex w-full items-center justify-between">
                        <div class="text-white-dark">Account Number:</div>
                        <div>1234567890</div>
                    </div>
                    <div class="mb-2 flex w-full items-center justify-between">
                        <div class="text-white-dark">SWIFT Code:</div>
                        <div>S58K796</div>
                    </div>
                    <div class="mb-2 flex w-full items-center justify-between">
                        <div class="text-white-dark">IBAN:</div>
                        <div>L5698445485</div>
                    </div>
                    <div class="mb-2 flex w-full items-center justify-between">
                        <div class="text-white-dark">Country:</div>
                        <div>United States</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive mt-6">
            <table class="table-striped">
                <thead>
                    <tr>
                        <th>Sr. No.</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Basic Value</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($orderDetails) > 0)
                    <?php $i = 1; ?>
                    @foreach($orderDetails as $item)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $item->product_name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>₹{{ number_format($item->amount,2) }}</td>
                        <td>₹{{ number_format($item->total_amount,2) }}</td>
                    </tr>
                    <?php $i++; ?>
                    @endforeach
                    @else
                    <tr><td colspan='5' align="center"><b> Data Not Found </b></td></tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="mt-6 grid grid-cols-1 px-4 sm:grid-cols-2">
            <div></div>
            <div class="space-y-2 ltr:text-right rtl:text-left">
                <div class="flex items-center">
                    <div class="flex-1">Subtotal</div>
                    <div class="w-[37%]">$3255</div>
                </div>
                <div class="flex items-center">
                    <div class="flex-1">Tax</div>
                    <div class="w-[37%]">$700</div>
                </div>
                <div class="flex items-center">
                    <div class="flex-1">Shipping Rate</div>
                    <div class="w-[37%]">$0</div>
                </div>
                <div class="flex items-center">
                    <div class="flex-1">Discount</div>
                    <div class="w-[37%]">$10</div>
                </div>
                <div class="flex items-center text-lg font-semibold">
                    <div class="flex-1">Grand Total</div>
                    <div class="w-[37%]">$3945</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection