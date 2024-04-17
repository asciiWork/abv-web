<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Quotation extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function listData()
    {
        return Quotation::select('quotations.*', 'admin_users.image as uimg','admin_users.name as uname','clients.name as cname', 'clients.phone_1 as cphone')
        ->leftJoin('admin_users', 'admin_users.id', '=', 'quotations.user_id')
        ->leftJoin('clients', 'clients.id', '=', 'quotations.client_id');
    }
    public static function getQuotationNumber()
    {
        //A0001/24-25
        $newString = 'A0001/24-25';
        $row = Quotation::where('is_invoice', 0)->orderBy('id','Desc')->first();
        $originalString = ($row)? $row->quotation_number: "A0001/24-25";
        preg_match('/A(\d+)/', $originalString, $matches);
        $number = isset($matches[1]) ? $matches[1] : null;
        if ($number !== null) {
            $incrementedNumber = str_pad((int)$number + 1, strlen($number), '0', STR_PAD_LEFT);
            $newString = preg_replace('/A\d+/', 'A' . $incrementedNumber, $originalString);
        }
        return $newString;
    }
    public static function getInvoiceNumber()
    {
        //ABV0001/24-25
        $newString = 'ABV0001/24-25';
        $row = Quotation::where('is_invoice', 1)->orderBy('id','Desc')->first();
        $originalString = ($row)? $row->invoice_number: "ABV0000/24-25";
        preg_match('/ABV(\d+)/', $originalString, $matches);
        $number = isset($matches[1]) ? $matches[1] : null;
        if ($number !== null) {
            $incrementedNumber = str_pad((int)$number + 1, strlen($number), '0', STR_PAD_LEFT);
            $newString = preg_replace('/ABV\d+/', 'ABV' . $incrementedNumber, $originalString);
        }
        return $newString;
    }
    public static function getStatics()
    {
        $yearly_total = Quotation::where('invoice_date','LIKE','%'.date('Y').'%');
        $monthly_total = Quotation::where('invoice_date','LIKE','%'.date('Y-m').'%');
        $today_total = Quotation::where('invoice_date','LIKE','%'.date('Y-m-d').'%');
        $total_qns = Quotation::where('is_invoice',0);

        if (\Auth::guard('admins')->user()->user_type_id != 1) {
            $yearly_total = $yearly_total->where('user_id',\Auth::guard('admins')->user()->id);
            $monthly_total = $monthly_total->where('user_id',\Auth::guard('admins')->user()->id);
            $today_total = $today_total->where('user_id',\Auth::guard('admins')->user()->id);
            $total_qns = $total_qns->where('user_id',\Auth::guard('admins')->user()->id);
        }
        $yearly_total = $yearly_total->sum('final_total_amount');
        $monthly_total = $monthly_total->sum('final_total_amount');
        $today_total = $today_total->sum('final_total_amount');
        $total_qns = $total_qns->count();

        return ['yearly_total'=> $yearly_total,
            'today_total' => $today_total,
            'monthly_total' => $monthly_total,
            'total_qns' => $total_qns,
        ];
    }
    public static function allProducts()
    {
        $product = DB::table('product_size')
        ->select('product_size.id', 'product.id as product_id', 'product_size.product_code','product.product_name', 'product_size.product_size', 'product_size.product_current_price as price')
        ->leftJoin('product', 'product.id', '=', 'product_size.product_id')
        ->leftJoin('product_category', 'product_category.id', '=', 'product.category_id')
        ->where('product_category.status', '1')
        ->groupBy('product_size.id')
        ->get();
        return $product;
    }
    public static function validationRule($request, $id = 0)
    {
        $status = 1;
        $msg = '';
        $data = array();
        $rules = [
           'quotation_number' => 'required|min:2',
           'quotation_date' => 'required',
           'quotation_due_date' => 'required',
           'client_id' => 'required',
            'product_id.*' => 'required',
            'taxable_value' => 'required',
            'tax_amount' => 'required',
            'total_amount' => 'required',
        ];
        $validator = \Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $messages = $validator->messages();
            $status = 0;
            $msg = "";
            foreach ($messages->all() as $message) {
                $msg .= $message . "<br />";
            }
        }

        return ['status' => $status, 'msg' => $msg, 'data' => $data];
    }
    public static function totalOrdersToday($user_id=''){
        $startOfDay = Carbon::now()->startOfDay();
        $endOfDay = Carbon::now()->endOfDay();
        $totalOrdersToday= Quotation::where('is_invoice',1)->whereBetween('created_at', [$startOfDay, $endOfDay]);
        if($user_id!=''){
            $totalOrdersToday =$totalOrdersToday->where('user_id',$user_id);
        }
        return $totalOrdersToday->count();
    }
    public static function MonthlyOrders($user_id=''){
        $MonthlyOrders= Quotation::where('is_invoice',1)->whereMonth('created_at', Carbon::now()->month)
        ->whereYear('created_at', Carbon::now()->year);
        if($user_id!=''){
            $MonthlyOrders =$MonthlyOrders->where('user_id',$user_id);
        }
        return $MonthlyOrders->count();
    }
    public static function totalOrders($user_id=''){
        $totalOrders= Quotation::where('is_invoice',1);
        if($user_id!=''){
                $totalOrders =$totalOrders->where('user_id',$user_id);
        }
        return $totalOrders->count();
    }
    public static function totalSale($user_id=''){
        $totalSale=DB::table('quotations')
        ->where('is_invoice',1);
        if($user_id!=''){
            $totalSale =$totalSale->where('user_id',$user_id);
        }
        return $totalSale->sum('final_total_amount');
    }
    public static function totalSaleToday($user_id=''){
        $today = Carbon::today()->toDateString();
        $totalSaleToday=Quotation::whereDate('created_at', $today)->where('is_invoice',1);
        if($user_id!=''){
            $totalSaleToday =$totalSaleToday->where('user_id',$user_id);
        }
        return $totalSaleToday->sum('final_total_amount');
    }
    public static function totalSaleWeekly($user_id=''){
        $startOfWeek = Carbon::now()->startOfWeek()->toDateString();
        $endOfWeek = Carbon::now()->endOfWeek()->toDateString();
        $totalSaleWeekly= Quotation::whereBetween('created_at', [$startOfWeek, $endOfWeek])->where('is_invoice',1);
        if($user_id!=''){
                $totalSaleWeekly =$totalSaleWeekly->where('user_id',$user_id);
        }
        return $totalSaleWeekly->sum('final_total_amount');
    }
    public static function monthlySale($user_id=''){
        $startOfMonth = Carbon::now()->startOfMonth()->toDateString();
        $endOfMonth = Carbon::now()->endOfMonth()->toDateString();
        $monthlySale=Quotation::whereBetween('created_at', [$startOfMonth, $endOfMonth])->where('is_invoice',1);
        if($user_id!=''){
                $monthlySale =$monthlySale->where('user_id',$user_id);
        }
        return $monthlySale->sum('final_total_amount');
    }
    public static function yearSale($user_id=''){
        $startOfYear = Carbon::now()->startOfYear();
        $endOfYear = Carbon::now()->endOfYear();
        $yearSale=Quotation::whereBetween('created_at', [$startOfYear, $endOfYear])->where('is_invoice',1);
        if($user_id!=''){
                $yearSale =$yearSale->where('user_id',$user_id);
        }
        return $yearSale->sum('final_total_amount');
    }
    public static function dailySalesOverview($user_id=''){
        $dailyData = Quotation::select(
            DB::raw('DAYNAME(created_at) as day_name'),
            DB::raw('COUNT(id) as total_orders')
        )->where('is_invoice',1);
        if($user_id!=''){
            $dailyData =$dailyData->where('user_id',$user_id);
        }
        $dailyData=$dailyData->groupBy('day_name')
        ->orderByRaw("FIELD(day_name, 'Mon', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')")
        ->get();
        $dailyOverviewTot = $salesdayName=[];
        foreach ($dailyData as $data) {
            $dailyOverviewTot[] = $data->total_orders;
            $salesdayName[] = $data->day_name;
            $data->day_name. $data->total_orders;
        }
        return ['dailyOverviewTot'=>$dailyOverviewTot,'salesdayName'=>$salesdayName];
    }
    public static function weeklySalesOverview($user_id=''){
      $salesOverview = Quotation::select(
            DB::raw('YEAR(created_at) as year_number'),
            DB::raw('WEEK(created_at, 1) as week_number'), // 1 specifies that the week starts on Monday
            DB::raw('COUNT(id) as total_orders')
        )->where('is_invoice',1);
        if($user_id!=''){
            $salesOverview =$salesOverview->where('user_id',$user_id);
        }
        $salesOverview = $salesOverview->groupBy('year_number', 'week_number')->get();

        $weekOverviewTot = $salesweekNum=[];
        foreach ($salesOverview as $overview) {
            $weekOverviewTot[] = $overview->total_orders;
            $salesweekNum[] = 'Week '.$overview->week_number;
        }
        return ['weekOverviewTot'=>$weekOverviewTot,'salesweekNum'=>$salesweekNum];
    }
    public static function monthlySalesOverview($user_id=''){
        $monthlyData = Quotation::select(
            DB::raw('YEAR(created_at) as year_number'),
            DB::raw('MONTH(created_at) as month_number'),
            DB::raw('SUM(final_total_amount ) as total_sum_of_price'),
            DB::raw('COUNT(id) as total_orders')
        )->where('is_invoice',1);
        if($user_id!=''){
            $monthlyData =$monthlyData->where('user_id',$user_id);
        }
        $monthlyData=$monthlyData->groupBy('year_number', 'month_number')->get();
        $monthNames = [1 => 'Jan',2 => 'Feb',3 => 'Mar',4 => 'Apr',5 => 'May',6 => 'Jun',7 => 'Jul',8 => 'Aug',9 => 'Sep',10 => 'Oct',11 => 'Nov',12 => 'Dec'];
        $monthOverviewTot=$monthName = [];
        foreach ($monthlyData as $data) {
          $monthName[] = $monthNames[$data->month_number];
          $monthOverviewTot[] = $data->total_orders;
        }
        return ['monthOverviewTot'=>$monthOverviewTot,'monthName'=>$monthName];
    }
    public static function yearlySalesOverview($user_id=''){
        $yearlyData = Quotation::select(
            DB::raw('YEAR(created_at) as year_number'),
            DB::raw('SUM(final_total_amount) as total_sum_of_price'),
            DB::raw('COUNT(id) as total_orders')
        )->where('is_invoice',1);
        if($user_id!=''){
            $yearlyData =$yearlyData->where('user_id',$user_id);
        }
        $yearlyData=$yearlyData->groupBy('year_number')
        ->get();
        $yearOverviewTot = $salesyearNum=[];
        foreach ($yearlyData as $data) {
            $yearOverviewTot[] = $data->total_orders;
            $salesyearNum[] = 'Year '.$data->year_number;
        }
        return ['yearOverviewTot'=>$yearOverviewTot,'salesyearNum'=>$salesyearNum];
    }
}
