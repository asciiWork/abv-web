@extends('adminPanel.layouts.app')
@section('adminContent')
<div x-data="basic">    
    <div class="panel mt-6">
        <h5 class="text-lg font-semibold dark:text-white-light">Users</h5>
        <table id="myTable1" class="table-hover whitespace-nowrap">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @if($records)
                  @foreach($records as $raw)
                    <tr>
                      <td>{{ $raw->id }}</td>
                      <td>{{ $raw->name }}</td>
                      <td>{{ $raw->email }}</td>
                    </tr>
                  @endforeach
                @else
                  <tr>
                    <td colspan="3" >Data Not Found</td>
                  </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('adminscript')
<script src="{{ asset('admin-theme/assets/js/simple-datatables.js')}}"></script>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('basic', () => ({
            datatable: null,
            init() {
                this.datatable = new simpleDatatables.DataTable('#myTable', {
                    data: {
                        headings: ['ID', 'First Name', 'Last Name', 'Email', 'Phone'],
                        data: [
                            [1, 'Caroline', 'Jensen', 'carolinejensen@zidant.com', '+1 (821) 447-3782'],
                            [2, 'Celeste', 'Grant', 'celestegrant@polarax.com', '+1 (838) 515-3408'],
                            [3, 'Tillman', 'Forbes', 'tillmanforbes@manglo.com', '+1 (969) 496-2892'],
                            [4, 'Daisy', 'Whitley', 'daisywhitley@applideck.com', '+1 (861) 564-2877'],
                            [5, 'Weber', 'Bowman', 'weberbowman@volax.com', '+1 (962) 466-3483'],
                            [6, 'Buckley', 'Townsend', 'buckleytownsend@orbaxter.com', '+1 (884) 595-2643'],
                            [7, 'Latoya', 'Bradshaw', 'latoyabradshaw@opportech.com', '+1 (906) 474-3155'],
                            [8, 'Kate', 'Lindsay', 'katelindsay@gorganic.com', '+1 (930) 546-2952'],
                            [9, 'Marva', 'Sandoval', 'marvasandoval@avit.com', '+1 (927) 566-3600'],
                            [10, 'Decker', 'Russell', 'deckerrussell@quilch.com', '+1 (846) 535-3283'],
                            [11, 'Odom', 'Mills', 'odommills@memora.com', '+1 (995) 525-3402'],
                            [12, 'Sellers', 'Walters', 'sellerswalters@zorromop.com', '+1 (830) 430-3157'],
                            [13, 'Wendi', 'Powers', 'wendipowers@orboid.com', '+1 (863) 457-2088'],
                            [14, 'Sophie', 'Horn', 'sophiehorn@snorus.com', '+1 (885) 418-3948'],
                            [15, 'Levine', 'Rodriquez', 'levinerodriquez@xth.com', '+1 (999) 565-3239'],
                            [16, 'Little', 'Hatfield', 'littlehatfield@comtract.com', '+1 (812) 488-3011'],
                            [17, 'Larson', 'Kelly', 'larsonkelly@zidant.com', '+1 (892) 484-2162'],
                            [18, 'Kendra', 'Molina', 'kendramolina@sureplex.com', '+1 (920) 528-3330'],
                            [19, 'Ebony', 'Livingston', 'ebonylivingston@danja.com', '+1 (970) 591-3039'],
                            [20, 'Kaufman', 'Rush', 'kaufmanrush@euron.com', '+1 (924) 463-2934'],
                            [21, 'Frank', 'Hays', 'frankhays@illumity.com', '+1 (930) 577-2670'],
                            [22, 'Carmella', 'Mccarty', 'carmellamccarty@sybixtex.com', '+1 (876) 456-3218'],
                            [23, 'Massey', 'Owen', 'masseyowen@zedalis.com', '+1 (917) 567-3786'],
                            [24, 'Lottie', 'Lowery', 'lottielowery@dyno.com', '+1 (912) 539-3498'],
                            [25, 'Addie', 'Luna', 'addieluna@multiflex.com', '+1 (962) 537-2981'],
                        ],
                    },
                    sortable: false,
                    searchable: false,
                    perPage: 10,
                    perPageSelect: [10, 20, 30, 50, 100],
                    firstLast: true,
                    firstText:
                        '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M13 19L7 12L13 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> <path opacity="0.5" d="M16.9998 19L10.9998 12L16.9998 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
                    lastText:
                        '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M11 19L17 12L11 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> <path opacity="0.5" d="M6.99976 19L12.9998 12L6.99976 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
                    prevText:
                        '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M15 5L9 12L15 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
                    nextText:
                        '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
                    labels: {
                        perPage: '{select}',
                    },
                    layout: {
                        top: '{search}',
                        bottom: '{info}{select}{pager}',
                    },
                });
            },
        }));
    });
</script>
@endsection