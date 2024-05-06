<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quotation;
use App\Models\QuotationItem;
use App\Models\Client;
use App\Models\Admin;
use App\Models\LastInvoicePrice;
use App\Models\Product;
use DataTables;
// use Barryvdh\DomPDF\Facade\Pdf;

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
        $data['breadcrumb'] = array('Quotations' => '');
        $data['qnStatics'] = Quotation::getStatics();
        $data['add_url'] = route($this->moduleRouteText . '.create');
        $data['currentRoute'] = $this->moduleRouteText;
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
                $qData->total_amount_value = round($request->get('total_amount_value'),2);
                $qData->final_total_amount = round($request->get('final_total_amount'),2);
                $qData->client_address = $request->get('client_address');
                $qData->ship_address = $request->get('ship_address');
                $qData->ship_city = $request->get('ship_city');
                $qData->ship_state = $request->get('ship_state');
                $qData->ship_pincode = $request->get('ship_pincode');
                $qData->bill_landmark = $request->get('bill_landmark');
                $qData->ship_landmark = $request->get('ship_landmark');
                $qData->bill_address = $request->get('bill_address');
                $qData->bill_city = $request->get('bill_city');
                $qData->bill_state = $request->get('bill_state');
                $qData->bill_pincode = $request->get('bill_pincode');
                $qData->client_gstn = $request->get('client_gstn');
                $qData->shipping_amount = $request->get('shipping_amount');
                $qData->igst_amount = $request->get('igst_amount');
                $qData->cgst_amount = $request->get('cgst_amount');
                $qData->sgst_amount = $request->get('sgst_amount');
                $qData->is_igst = $request->get('is_igst');
                $qData->sub_final_total_amount = $request->get('sub_final_total_amount');
                $qData->discount = $request->get('discount');
                $qData->final_total_amount_words = $request->get('final_total_amount_words');
                $qData->save();
                $qID = $qData->id;

                $allProducts = $request->get('product_id');
                $product_size_id = $request->get('product_size_id');
                $allQuantity = $request->get('quantity');
                $alltaxable_value = $request->get('taxable_value');
                $alltax_amount = $request->get('tax_amount');
                $alltotal_amount = $request->get('total_amount');
                $product_actual_price = $request->get('product_actual_price');
                $allhsn_code = $request->get('product_hsn_code');
                $item_name = $request->get('item_name');
                $total_qnt = 0;
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
                    $qnData->product_hsn_code = isset($allhsn_code[$i])?$allhsn_code[$i]:'';
                    $qnData->save();
                    $total_qnt += $qnData->quantity;

                    Product::where('id', $qnData->product_id)->update(['hsn_code'=> $qnData->product_hsn_code]);
                }
                $qData->total_qnt = $total_qnt;
                $qData->save();

                if($request->get('is_invoice')){
                    $qData->invoice_number = Quotation::getInvoiceNumber();
                    $qData->invoice_date = date('Y-m-d');
                    $qData->is_invoice = 1;
                    $qData->save();
                }
                $itemssss = QuotationItem::where('quotation_id', $qID)->get();
                foreach ($itemssss as $itm) {
                    $lst = new LastInvoicePrice();
                    $lst->product_id = $itm->product_id;
                    $lst->product_size_id = $itm->product_size_id;
                    $lst->client_id = $qData->client_id;
                    $lst->price = $itm->product_actual_price;
                    $lst->save();
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
            $formObj = $formObj->where('user_id', \Auth::guard('admins')->user()->id)->where('is_invoice', 0);
        }
        $formObj = $formObj->where('is_paid', 0)->find($id);

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

    public function show($id, Request $request)
    {
        // return view($this->moduleViewName . '.demoPdf');

        // $pdf = PDF::loadView($this->moduleViewName . '.demoPdf')->setOptions(['chroot'  => public_path('images/')]);
        // $fileName = "quotation_.pdf";
        // return $pdf->download($fileName);

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
        if($request->get('isPdf')){
            // $pdf = PDF::loadView($this->moduleViewName . '.pdf', $data)->setOptions(['chroot'  => public_path('images/')]);
            // $fileName = "quotation_" . $formObj->quotation_number . ".pdf";
            // if ($formObj->is_invoice) {
            //     $fileName = "invoice_" . $formObj->invoice_number . ".pdf";
            // }
            // return $pdf->download($fileName);
            return view($this->moduleViewName . '.pdf', $data)->render();
        } else if ($request->get('isPrint')){
            return view($this->moduleViewName . '.pdf', $data)->render();
        }else{
            return view($this->moduleViewName . '.show', $data);
        }
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
                $model->total_amount_value = round($request->get('total_amount_value'), 2);
                $model->final_total_amount = round($request->get('final_total_amount'), 2);
                $model->client_address = $request->get('client_address');
                $model->ship_address = $request->get('ship_address');
                $model->ship_city = $request->get('ship_city');
                $model->ship_state = $request->get('ship_state');
                $model->ship_pincode = $request->get('ship_pincode');
                $model->bill_address = $request->get('bill_address');
                $model->bill_city = $request->get('bill_city');
                $model->bill_state = $request->get('bill_state');
                $model->bill_pincode = $request->get('bill_pincode');
                $model->client_gstn = $request->get('client_gstn');
                $model->shipping_amount = $request->get('shipping_amount');
                $model->igst_amount = $request->get('igst_amount');
                $model->cgst_amount = $request->get('cgst_amount');
                $model->bill_landmark = $request->get('bill_landmark');
                $model->ship_landmark = $request->get('ship_landmark');
                $model->sgst_amount = $request->get('sgst_amount');
                $model->is_igst = $request->get('is_igst');
                $model->sub_final_total_amount = $request->get('sub_final_total_amount');
                $model->discount = $request->get('discount');
                $model->final_total_amount_words = $request->get('final_total_amount_words');
                $model->save();

                $allProducts = $request->get('product_id');
                $product_size_id = $request->get('product_size_id');
                $allQuantity = $request->get('quantity');
                $alltaxable_value = $request->get('taxable_value');
                $alltax_amount = $request->get('tax_amount');
                $alltotal_amount = $request->get('total_amount');
                $product_actual_price = $request->get('product_actual_price');
                $item_name = $request->get('item_name');
                $allhsn_code = $request->get('product_hsn_code');
                QuotationItem::where('quotation_id', $id)->delete();
                $total_qnt=0;
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
                    $qnData->product_hsn_code = isset($allhsn_code[$i]) ? $allhsn_code[$i] : '';
                    $qnData->save();
                    $total_qnt += $qnData->quantity;
                }
                $model->total_qnt = $total_qnt;
                $model->save();

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
                $html = '<span class="lable-table bg-warning-subtle text-warning rounded border border-warning-subtle font-text4 fw-bold">Q: '. $row->quotation_number. '</span>';
                if($row->is_invoice){
                    $html .= '<br/><span class="lable-table bg-primary-subtle text-primary rounded border border-primary-subtle font-text4 fw-bold">I: '. $row->invoice_number.'</span>';
                }
                return $html;
            })
            ->editColumn('final_total_amount', function ($row) {
                return number_format($row->final_total_amount,2);
            })
            ->editColumn('cname', function ($row) {
                return $row->cname.'<br/>'. $row->cphone;
            })
            ->editColumn('quotation_due_date', function ($row) {
                return date('Y, M-d',strtotime($row->quotation_due_date));
            })
            ->editColumn('quotation_date', function ($row) {
                $html = 'Q: '. date('Y, M-d',strtotime($row->quotation_date));
                if($row->is_invoice){
                    $html .= '<br/>I: &nbsp;&nbsp;'. date('Y, M-d', strtotime($row->invoice_date));
                }
                return $html;
            })
            ->editColumn('user_id', function ($row) {
                $url = Admin::getAvtar($row->uimg);
                $html = '<img src="'.$url. '" class="rounded-circle" width="40" height="40"> &nbsp;'. $row->uname;
                return $html;
            })
            ->addColumn('action', function ($row) {
                $markAsInvoice = (\Auth::guard('admins')->user()->user_type_id == 1)?1:0;
                return view(
                    "adminPanel.includes.actions",
                    [
                        'currentRoute' => $this->moduleRouteText,
                        'row' => $row,
                        'isEdit' => ($row->is_invoice)?0:1,
                        'isDelete' => 0,
                        'isInvoice' => $markAsInvoice,
                        'isView' => 1,
                    ]
                )->render();
            })
            ->rawColumns(['action', 'quotation_number', 'quotation_date', 'user_id', 'cname'])
            ->filter(function ($query) {
                $search_user = request()->get("search_user");
                $search_qn_number = request()->get("search_qn_number");
                $search_client_name = request()->get("search_client_name");
                $search_client_phone = request()->get("search_client_phone");
                $search_date = request()->get("search_date");
                if(\Auth::guard('admins')->user()->user_type_id != 1)
                {
                    $query = $query->where("admin_users.id", \Auth::guard('admins')->user()->id);
                }
                if (!empty($search_user)) {
                    $query = $query->where("admin_users.name", "LIKE", '%'. $search_user.'%');
                }
                if (!empty($search_qn_number)) {
                        $query = $query->where(function ($qry) use ($search_qn_number) {
                            $qry = $qry->where("quotations.quotation_number", "LIKE", '%' . $search_qn_number . '%')
                                ->orWhere("quotations.invoice_number", "LIKE", '%' . $search_qn_number . '%');
                        });
                }
                if (!empty($search_client_name)) {
                    $query = $query->where("clients.name", "LIKE", '%'. $search_client_name.'%');
                }
                if (!empty($search_client_phone)) {
                    $query = $query->where("clients.phone_1", "LIKE", '%'. $search_client_phone.'%');
                }
                if (!empty($search_date)) {
                    $query = $query->where("quotations.quotation_date", "LIKE", '%'. date('Y-m-d',strtotime($search_date)).'%');
                }
            })
            ->make(true);
    }
    public function makeInvoice($id, Request $request)
    {
        /*------------ACL-----------------*/
        if (!\App\Models\ACL::isAccess()) {
            return abort(404);
        }
        /*--------------------------------*/

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
