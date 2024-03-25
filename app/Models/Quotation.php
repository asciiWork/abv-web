<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Quotation extends Model
{
    use HasFactory;

    public function listData()
    {
        return Quotation::select('*');
    }
    public static function getQuotationNumber()
    {
        $row = Quotation::orderBy('id','Desc')->first();
        $no = ($row)? intval(str_replace("EST-", "", $row->quotation_number))+1:0;
        return 'EST-'.$no;
    }
    public static function allProducts()
    {
        $product = DB::table('product_size')
        ->select('product_size.id', 'product.product_name', 'product_size.product_size', 'product_size.product_current_price as price')
        ->leftJoin('product', 'product.id', '=', 'product_size.product_id')
        ->leftJoin('product_category', 'product_category.id', '=', 'product.category_id')
        ->where('product_category.status', '1')
        ->groupBy('product_size.id')
        ->get();
        return $product;
    }
}
