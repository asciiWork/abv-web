@extends('adminPanel.layouts.app')
@section('adminContent')
<div>
    <div class="flex flex-col gap-2.5 xl:flex-row">
        <div class="panel flex-1 px-0 py-6 ltr:lg:mr-6 rtl:lg:ml-6">
            <div class="flex flex-wrap justify-between px-4">
                <div class="mb-6 w-full lg:w-1/2">
                    <div class="flex shrink-0 items-center text-black dark:text-white">
                        <img src="{{ asset('public/web/assets/img/abv.png') }}" alt="image" class="w-14" />
                    </div>
                    <div class="mt-6 space-y-1 text-gray-500 dark:text-gray-400">
                        <div>ABV TOOL</div>
                        <div>A-205, Krish Elite Commercial Complex, Nr Vishala Land Mark,B/H Sankalp International School, Ahmedabad-382350, Gujarat, India</div>
                        <div>abvtradesol@gamil.com</div>
                        <div>+91 78744 27439, +91 84695 55348</div>
                    </div>
                </div>
                <div class="w-full lg:w-1/2 lg:max-w-fit">
                    <div class="flex items-center">
                        <label for="number" class="mb-0 flex-1 ltr:mr-2 rtl:ml-2">Quotation</label>
                        <input
                            id="number"
                            type="text"
                            name="inv-num"
                            class="form-input w-2/3 lg:w-[250px]"
                            placeholder="#8801"
                            
                        />
                    </div>
                    <div class="mt-4 flex items-center">
                        <label for="startDate" class="mb-0 flex-1 ltr:mr-2 rtl:ml-2">Quotation Date</label>
                        <input
                            id="startDate"
                            type="date"
                            name="inv-date"
                            class="form-input w-2/3 lg:w-[250px]"
                            
                        />
                    </div>
                    <div class="mt-4 flex items-center">
                        <label for="dueDate" class="mb-0 flex-1 ltr:mr-2 rtl:ml-2">Due Date</label>
                        <input id="dueDate" type="date" name="due-date" class="form-input w-2/3 lg:w-[250px]"  />
                    </div>
                </div>
            </div>
            <hr class="my-6 border-[#e0e6ed] dark:border-[#1b2e4b]" />
            <div class="mt-8 px-4">
                <div class="flex flex-col justify-between lg:flex-row">
                    <div class="mb-6 w-full lg:w-1/2 ltr:lg:mr-6 rtl:lg:ml-6">
                        <div class="text-lg font-semibold">Customer Details</div>
                        <div class="mt-4 flex items-center">
                            <label for="reciever-name" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Customer</label>
                            <input
                                id="reciever-name"
                                type="text"
                                name="reciever-name"
                                class="form-input flex-1"
                                placeholder="Enter Name"
                            />
                        </div>
                    </div>
                    <div class="w-full lg:w-1/2">
                        <div class="text-lg font-semibold">Payment Details</div>
                    </div>
                </div>
            </div>
            <div class="mt-8">
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th class="w-1">#</th>
                                <th>Item</th>
                                <th >Rate / Item</th>
                                <th>Qty</th>
                                <th >Taxable Value</th>
                                <th >Tax Amount</th>
                                <th >Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                             <tr>
                             	<td></td>
                             	<td>
                             		<input
		                                type="text"
		                                name="reciever-name"
		                                class="form-input flex-1"
		                                placeholder="Search Item"
	                            	/>
	                            </td>
                             	<td><input
		                                type="text"
		                                name="reciever-name"
		                                class="form-input flex-1"
		                                placeholder="Search Item"
	                            	/></td>
                             	<td><input
		                                type="text"
		                                name="reciever-name"
		                                class="form-input flex-1"
		                                placeholder="Search Item"
	                            	/></td>
                             	<td>00.00</td>
                             	<td>00.00</td>
                             	<td>00.00</td>
                             </tr>
                        </tbody>
                    </table>
                </div>
                <div class="mt-6 flex flex-col justify-between px-4 sm:flex-row">
                    <div class="mb-6 sm:mb-0">
                        <button type="button" class="btn btn-primary" @click="addItem()">Add Item</button>
                    </div>
                    <div class="sm:w-2/5">
                        <div class="flex items-center justify-between">
                            <div>Subtotal</div>
                            <div>$0.00</div>
                        </div>
                        <div class="mt-4 flex items-center justify-between">
                            <div>Tax(%)</div>
                            <div>0%</div>
                        </div>
                        <div class="mt-4 flex items-center justify-between">
                            <div>Shipping Rate($)</div>
                            <div>$0.00</div>
                        </div>
                        <div class="mt-4 flex items-center justify-between">
                            <div>Discount(%)</div>
                            <div>0%</div>
                        </div>
                        <div class="mt-4 flex items-center justify-between font-semibold">
                            <div>Total</div>
                            <div>$0.00</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-8 px-4">
                <div>
                    <label for="notes">Notes</label>
                    <textarea
                        id="notes"
                        name="notes"
                        class="form-textarea min-h-[130px]"
                        placeholder="Notes...."
                    ></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="w-full xl:mt-0 xl:w-96">
        <div class="panel">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-1">
                <button type="button" class="btn btn-success w-full gap-2">
                    <svg
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 shrink-0 ltr:mr-2 rtl:ml-2"
                    >
                        <path
                            d="M3.46447 20.5355C4.92893 22 7.28595 22 12 22C16.714 22 19.0711 22 20.5355 20.5355C22 19.0711 22 16.714 22 12C22 11.6585 22 11.4878 21.9848 11.3142C21.9142 10.5049 21.586 9.71257 21.0637 9.09034C20.9516 8.95687 20.828 8.83317 20.5806 8.58578L15.4142 3.41944C15.1668 3.17206 15.0431 3.04835 14.9097 2.93631C14.2874 2.414 13.4951 2.08581 12.6858 2.01515C12.5122 2 12.3415 2 12 2C7.28595 2 4.92893 2 3.46447 3.46447C2 4.92893 2 7.28595 2 12C2 16.714 2 19.0711 3.46447 20.5355Z"
                            stroke="currentColor"
                            stroke-width="1.5"
                        />
                        <path
                            d="M17 22V21C17 19.1144 17 18.1716 16.4142 17.5858C15.8284 17 14.8856 17 13 17H11C9.11438 17 8.17157 17 7.58579 17.5858C7 18.1716 7 19.1144 7 21V22"
                            stroke="currentColor"
                            stroke-width="1.5"
                        />
                        <path opacity="0.5" d="M7 8H13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                    Save
                </button>
            </div>
        </div>
    </div>
</div>
@endsection