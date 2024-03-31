<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Quotation extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function listData()
    {
        return Quotation::select('quotations.*','admin_users.name as uname','clients.name as cname')
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
}
