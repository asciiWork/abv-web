<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quotation;
use App\Models\QuotationItem;
use App\Models\Client;
use App\Models\LastInvoicePrice;
use DataTables;

class QuotationsController extends Controller
{
    public function __construct()
    {
        $this->moduleRouteText = "admin-quotations";
        $this->moduleViewName = "adminPanel.quotations";
        $this->list_url = route($this->moduleRouteText . ".index");

        $module = "Quotation";
        $this->module = $module;

        $this->modelObj = new Quotation();
        $this->addMsg = $module . " has been added successfully!";
        $this->updateMsg = $module . " has been updated successfully!";
        $this->deleteMsg = $module . " has been deleted successfully!";
        $this->deleteErrorMsg = $module . " can not deleted!";

        view()->share("list_url", $this->list_url);
        view()->share("moduleRouteText", $this->moduleRouteText);
        view()->share("moduleViewName", $this->moduleViewName);
    }

    public function index()
    {
        $data = array();
        $data['page_title'] = "Manage Quotations";
        $data['breadcrumb'] = array('Admin Quotations' => '');
        $data['qnStatics'] = Quotation::getStatics();
        $data['add_url'] = route($this->moduleRouteText . '.create');
        return view($this->moduleViewName . ".index", $data);
    }
    public function create()
    {
        $data = array();
        $data['formObj'] = $this->modelObj;
        $data['isEdit'] = 0;
        $data['quotation_number'] = Quotation::getQuotationNumber();
        $data['products'] = Quotation::allProducts();
        $data['clients'] = Client::allClients();
        $data['page_title'] = "Add " . $this->module;
        $data['breadcrumb'] = array('Add Quotation' => '');
        $data['action_url'] = $this->moduleRouteText . ".store";
        $data['back_url'] = $this->moduleRouteText . ".index";
        $data['action_params'] = 0;
        $data['buttonText'] = "Save";
        $data["method"] = "POST";
        return view($this->moduleViewName . '.add', $data);
    }
    public function store(Request $request)
    {
        $data = array();
        $status = 1;
        $msg = $this->addMsg;

        $checkValidation = $this->modelObj::validationRule($request);
        if (isset($checkValidation['status']) && $checkValidation['status'] == 0) {
            return ['status' => $checkValidation['status'], 'msg' => $checkValidation['msg'], 'data' => $checkValidation['data']];
        } else {
            try {
                $qData = new Quotation();
                $qData->user_id = \Auth::guard('admins')->user()->id;
                $qData->client_id = $request->get('client_id');
                $qData->quotation_number = $request->get('quotation_number');
                $qData->quotation_date = $request->get('quotation_date');
                $qData->quotation_due_date = $request->get('quotation_due_date');
                $qData->total_taxable_value = round($request->get('total_taxable_value'),2);
                $qData->shipping_amount = $request->get('shipping_amount');
                $qData->gst_amount = round($request->get('gst_amount'),2);
                $qData->final_total_amount = round($request->get('final_total_amount'),2);
                $qData->client_address = $request->get('client_address');
                $qData->save();
                $qID = $qData->id;

                $allProducts = $request->get('product_id');
                $product_size_id = $request->get('product_size_id');
                $allQuantity = $request->get('quantity');
                $alltaxable_value = $request->get('taxable_value');
                $alltax_amount = $request->get('tax_amount');
                $alltotal_amount = $request->get('total_amount');
                $product_actual_price = $request->get('product_actual_price');
                $item_name = $request->get('item_name');
                for ($i=0; $i < count($allProducts); $i++) {
                    $qnData = new QuotationItem();
                    $qnData->quotation_id = $qID;
                    $qnData->product_id = isset($allProducts[$i])?$allProducts[$i]:'';
                    $qnData->product_size_id = isset($product_size_id[$i])?$product_size_id[$i]:'';
                    $qnData->item_name = isset($item_name[$i])?$item_name[$i]:'';
                    $qnData->product_actual_price = isset($product_actual_price[$i])?$product_actual_price[$i]:'';
                    $qnData->quantity = isset($allQuantity[$i])?$allQuantity[$i]:'';
                    $qnData->taxable_value = isset($alltaxable_value[$i])?$alltaxable_value[$i]:'';
                    $qnData->tax_amount = isset($alltax_amount[$i])?$alltax_amount[$i]:'';
                    $qnData->total_amount = isset($alltotal_amount[$i])?$alltotal_amount[$i]:'';
                    $qnData->save();
                }

                session()->flash('success_message', $this->addMsg);
            } catch (\Exception $e) {
                $status = 0;
                $msg = $e->getMessage();
            }
            session()->flash('success_message', $msg);
        }

        return ['status' => $status, 'msg' => $msg, 'data' => $data];
    }

    public function edit($id, Request $request)
    {
        $formObj = $this->modelObj;
        if (\Auth::guard('admins')->user()->user_type_id != 1) {
            $formObj = $formObj->where('user_id', \Auth::guard('admins')->user()->id);
        }
        $formObj = $formObj->where('is_invoice', 0)->find($id);

        if (!$formObj) {
            abort(404);
        }
        $data = array();
        $data['formObj'] = $formObj;
        $data['quotation_number'] = $formObj->quotation_number;
        $data['isEdit'] = 1;
        $data['products'] = Quotation::allProducts();
        $data['qnItems'] = QuotationItem::where('quotation_id',$id)->get()->toArray();
        $data['clients'] = Client::allClients();
        $data['page_title'] = "Edit " . $this->module;
        $data['breadcrumb'] = array('Edit Quotation' => '');
        $data['back_url'] = $this->moduleRouteText . ".index";
        $data['buttonText'] = "Update";
        $data['action_url'] = $this->moduleRouteText . ".update";
        $data['action_params'] = $formObj->id;
        $data['method'] = "PUT";
        return view($this->moduleViewName . '.edit', $data);
    }

    public function show($id)
    {
        $formObj = $this->modelObj;
        if (\Auth::guard('admins')->user()->user_type_id != 1) {
            $formObj = $formObj->where('user_id', \Auth::guard('admins')->user()->id);
        }
        $formObj = $formObj->find($id);

        if (!$formObj) {
            abort(404);
        }
        $qnItems = QuotationItem::where('quotation_id', $id)->get();

        $data = array();
        $data['invoice'] = $formObj;
        $data['qnItems'] = $qnItems;
        $data['client'] = Client::find($formObj->client_id);
        $data['viewOrPdf'] = 0;
        return view($this->moduleViewName . '.invoicePDF', $data);
    }
    public function update(Request $request, $id)
    {
        $model = $this->modelObj->find($id);
        $data = array();
        $status = 1;
        $msg = $this->updateMsg;

        $checkValidation = $this->modelObj::validationRule($request, $id);
        if (!$model) {
            $status = 0;
            $msg = "Record not found !";
        } else if (isset($checkValidation['status']) && $checkValidation['status'] == 0) {
            return ['status' => $checkValidation['status'], 'msg' => $checkValidation['msg'], 'data' => $checkValidation['data']];
        } else {
            try {
                $model->client_id = $request->get('client_id');
                $model->quotation_number = $request->get('quotation_number');
                $model->quotation_date = $request->get('quotation_date');
                $model->quotation_due_date = $request->get('quotation_due_date');
                $model->total_taxable_value = round($request->get('total_taxable_value'),2);
                $model->shipping_amount = $request->get('shipping_amount');
                $model->gst_amount = round($request->get('gst_amount'),2);
                $model->final_total_amount = round($request->get('final_total_amount'),2);
                $model->client_address = $request->get('client_address');
                $model->save();

                $allProducts = $request->get('product_id');
                $product_size_id = $request->get('product_size_id');
                $allQuantity = $request->get('quantity');
                $alltaxable_value = $request->get('taxable_value');
                $alltax_amount = $request->get('tax_amount');
                $alltotal_amount = $request->get('total_amount');
                $product_actual_price = $request->get('product_actual_price');
                $item_name = $request->get('item_name');
                QuotationItem::where('quotation_id', $id)->delete();
                for ($i = 0; $i < count($allProducts); $i++) {
                    $qnData = new QuotationItem();
                    $qnData->quotation_id = $id;
                    $qnData->product_id = isset($allProducts[$i]) ? $allProducts[$i] : '';
                    $qnData->product_size_id = isset($product_size_id[$i]) ? $product_size_id[$i] : '';
                    $qnData->item_name = isset($item_name[$i]) ? $item_name[$i] : '';
                    $qnData->product_actual_price = isset($product_actual_price[$i]) ? $product_actual_price[$i] : '';
                    $qnData->quantity = isset($allQuantity[$i]) ? $allQuantity[$i] : '';
                    $qnData->taxable_value = isset($alltaxable_value[$i]) ? $alltaxable_value[$i] : '';
                    $qnData->tax_amount = isset($alltax_amount[$i]) ? $alltax_amount[$i] : '';
                    $qnData->total_amount = isset($alltotal_amount[$i]) ? $alltotal_amount[$i] : '';
                    $qnData->save();
                }

                session()->flash('success_message', $msg);
            } catch (\Exception $e) {
                $status = 0;
                $msg = $e->getMessage();
            }
            session()->flash('success_message', $msg);
        }
        return ['status' => $status, 'msg' => $msg, 'data' => $data];
    }

    public function data(Request $request)
    {
        $model = $this->modelObj->listData();
        return Datatables::eloquent($model)
            ->editColumn('quotation_number', function ($row) {
                $html = 'Q: '. $row->quotation_number;
                if($row->is_invoice){
                    $html .= '<br/>I: &nbsp;&nbsp;'. $row->invoice_number;
                }
                return $html;
            })
            ->editColumn('quotation_date', function ($row) {
                $html = 'Q: '. $row->quotation_date;
                if($row->is_invoice){
                    $html .= '<br/>I: &nbsp;&nbsp;'. $row->invoice_date;
                }
                return $html;
            })
            ->addColumn('action', function ($row) {
                return view(
                    "adminPanel.includes.actions",
                    [
                        'currentRoute' => $this->moduleRouteText,
                        'row' => $row,
                        'isEdit' => ($row->is_invoice)?0:1,
                        'isDelete' => 0,
                        'isInvoice' => 1,
                        'isView' => 1,
                    ]
                )->render();
            })
            ->rawColumns(['action', 'quotation_number', 'quotation_date'])
            ->filter(function ($query) {
                $search_user = request()->get("search_user");
                $search_number = request()->get("search_number");
                $search_client_name = request()->get("search_client_name");
                $search_date = request()->get("search_date");
                if(\Auth::guard('admins')->user()->user_type_id != 1)
                {
                    $query = $query->where("admin_users.id", \Auth::guard('admins')->user()->id);
                }
                if (!empty($search_user)) {
                    $query = $query->where("admin_users.name", "LIKE", '%'. $search_user.'%');
                }
                if (!empty($search_number)) {
                        $query = $query->where(function ($qry) use ($search_number) {
                            $qry = $qry->where("quotations.quotation_number", "LIKE", '%' . $search_number . '%')
                                ->orWhere("quotations.invoice_number", "LIKE", '%' . $search_number . '%');
                        });
                }
                if (!empty($search_client_name)) {
                    $query = $query->where(function($qry) use ($search_client_name){
                        $qry = $qry->where("clients.name", "LIKE", '%'. $search_client_name.'%')
                            ->orWhere("clients.phone_1", "LIKE", '%'. $search_client_name.'%');
                    });
                }
                if (!empty($search_date)) {
                    $query = $query->where("quotations.quotation_date", "LIKE", '%'. date('Y-m-d',strtotime($search_date)).'%');
                }
            })
            ->make(true);
    }
    public function makeInvoice($id, Request $request)
    {
        $formObj = $this->modelObj;
        if (\Auth::guard('admins')->user()->user_type_id != 1){
            $formObj = $formObj->where('user_id', \Auth::guard('admins')->user()->id);
        }
        $formObj = $formObj->where('is_invoice',0)->find($id);

        if (!$formObj) {
            abort(404);
        }
        $formObj->invoice_number = Quotation::getInvoiceNumber();
        $formObj->invoice_date = date('Y-m-d');
        $formObj->is_invoice = 1;
        $formObj->save();
        $items = QuotationItem::where('quotation_id', $id)->get();
        foreach ($items as $itm) {
            $lst = new LastInvoicePrice();
            $lst->product_id = $itm->product_id;
            $lst->product_size_id = $itm->product_size_id;
            $lst->client_id = $formObj->client_id;
            $lst->price = $itm->product_actual_price;
            $lst->save();
        }

        session()->flash('success_message', "Marked as invoice!");

        return redirect()->route($this->moduleRouteText.'.index');
    }
    public function lastPrices(Request $request)
    {
        $items = LastInvoicePrice::where('product_size_id', $request->get('product_size_id'))
            ->where('client_id', $request->get('client_id'))->orderBy('id','DESC')->first();
        return ($items)? $items->price:0;
    }
    public function downloadInvoice($id, Request $request)
    {
        $formObj = $this->modelObj;
        if (\Auth::guard('admins')->user()->user_type_id != 1) {
            $formObj = $formObj->where('user_id', \Auth::guard('admins')->user()->id);
        }
        $formObj = $formObj->find($id);

        if (!$formObj) {
            abort(404);
        }
        $qnItems = QuotationItem::where('quotation_id', $id)->get()->toArray();

        $data = array();
        $data['formObj'] = $formObj;
        $data['qnItems'] = $qnItems;
        $data['viewOrPdf'] = 0;
       // return view($this->moduleViewName . '.invoicePDF', $data)->render();
        //$pdf = PDF::loadView($this->moduleViewName . '.invoicePDF', $data)->setOptions(['defaultFont' => 'sans-serif', 'chroot'  => public_path('images/')]);
        $fileName = "quotation_" . $formObj->quotation_number. ".pdf";
        if($formObj->is_invoice){
            $fileName = "invoice_" . $formObj->invoice_number.".pdf";
        }

     //   return $pdf->download($fileName);
    }
}