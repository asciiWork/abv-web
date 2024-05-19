<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quotation;
use App\Models\QuotationItem;
use App\Models\Client;
use App\Models\Admin;
use App\Models\LastInvoicePrice;
use App\Models\InvoicePayment;
use DataTables;

class InvoicesController extends Controller
{
    public function __construct()
    {
        $this->moduleRouteText = "admin-invoices";
        $this->moduleViewName = "adminPanel.invoices";
        $this->list_url = route($this->moduleRouteText . ".index");

        $module = "Invoice";
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
        $data['page_title'] = "Manage Invoices";
        $data['breadcrumb'] = array('Invoices' => '');
        $data['qnStatics'] = Quotation::getStatics();
        $data['add_url'] = route('admin-quotations.create');
        $data['is_paymentLog'] = (\App\Models\ACL::isAdmin())?1:0;
        $data['currentRoute'] = $this->moduleRouteText;
        $data['back_url'] = $this->moduleRouteText . ".index";
        return view($this->moduleViewName . ".index", $data);
    }
    public function paymentsIndex()
    {
        /*------------ACL-----------------*/
        if (!\App\Models\ACL::isAccess()) {
            return abort(404);
        }
        /*--------------------------------*/

        $data = array();
        $data['page_title'] = "Payments";
        $data['breadcrumb'] = array('Invoice Payments' => '');
        $data['qnStatics'] = Quotation::getStatics();
        $data['add_url'] = route('admin-quotations.create');
        $data['currentRoute'] = $this->moduleRouteText;
        $data['back_url'] = $this->moduleRouteText . ".index";
        return view($this->moduleViewName . ".paymentIndex", $data);
    }
    public function paymentsData(Request $request)
    {
        /*------------ACL-----------------*/
        if (!\App\Models\ACL::isAccess()) {
            return abort(404);
        }
        /*--------------------------------*/

        $model = InvoicePayment::select('invoice_payments.*', 'quotations.invoice_number', 'quotations.client_id', 'quotations.final_total_amount', 'clients.company_name as comname', 'clients.name as cname', 'clients.phone_1 as cphone')
        ->leftJoin('quotations', 'quotations.id', 'invoice_payments.quotation_id')
        ->leftJoin('clients', 'clients.id', '=', 'quotations.client_id');

        return Datatables::eloquent($model)
            ->editColumn('invoice_number', function ($row) {
                return '<span class="lable-table bg-primary-subtle text-primary rounded border border-primary-subtle font-text4 fw-bold">I: ' . $row->invoice_number . '</span>';
            })
            ->editColumn('final_total_amount', function ($row) {
                return number_format($row->final_total_amount, 2);
            })
            ->editColumn('payment_type', function ($row) {
                $html = '<span class="lable-table bg-danger-subtle text-danger rounded border border-danger-subtle font-text2 fw-bold">'.$row->payment_type.'</span>';
                if($row->payment_detail){
                    $html .= '<br/>'. $row->payment_detail;
                }
                return $html;
            })
            ->editColumn('cname', function ($row) {
                return $row->cname . '<br/>' . $row->cphone;
            })
            ->editColumn('payment_date', function ($row) {
                return date('Y, M-d', strtotime($row->payment_date));
            })
            ->rawColumns(['invoice_number', 'payment_date', 'cname', 'final_total_amount', 'payment_type'])
            ->filter(function ($query) {
                $search_type = request()->get("search_type");
                $search_qn_number = request()->get("search_qn_number");
                $search_client_name = request()->get("search_client_name");
                $search_company = request()->get("search_company");
                $search_client_phone = request()->get("search_client_phone");
                $search_start_date = request()->get("search_start_date");
                $search_end_date = request()->get("search_end_date");
                if (\Auth::guard('admins')->user()->user_type_id != 1) {
                    $query = $query->where("admin_users.id", \Auth::guard('admins')->user()->id);
                }
                if (!empty($search_type)) {
                    $query = $query->where("invoice_payments.payment_type", "LIKE", '%' . $search_type . '%');
                }
                if (!empty($search_qn_number)) {
                    $query = $query->where(function ($qry) use ($search_qn_number) {
                        $qry = $qry->where("quotations.quotation_number", "LIKE", '%' . $search_qn_number . '%')
                            ->orWhere("quotations.invoice_number", "LIKE", '%' . $search_qn_number . '%');
                    });
                }
                if (!empty($search_client_name)) {
                    $query = $query->where("clients.name", "LIKE", '%' . $search_client_name . '%');
                }
                if (!empty($search_company)) {
                    $query = $query->where("clients.company_name", "LIKE", '%' . $search_company . '%');
                }
                if (!empty($search_client_phone)) {
                    $query = $query->where("clients.phone_1", "LIKE", '%' . $search_client_phone . '%');
                }
                if (!empty($search_start_date)) {
                    $query = $query->where("invoice_payments.payment_date", ">=", date('Y-m-d', strtotime($search_start_date)));
                }
                if (!empty($search_end_date)) {
                    $query = $query->where("invoice_payments.payment_date", "<=", date('Y-m-d', strtotime($search_end_date)));
                }
            })
            ->make(true);
    }
    public function data(Request $request)
    {
        $model = $this->modelObj->invoiceListData();

        $totalCounter = $this->modelObj->invoiceListData();
        $totalCounter = Quotation::listFilter($totalCounter);
        $amount_counter['amount_without_gst'] = number_format($totalCounter->sum('total_amount_value'),2);

        $totalCounter2 = $this->modelObj->invoiceListData();
        $totalCounter2 = Quotation::listFilter($totalCounter2);
        $amount_counter['amount_with_gst'] = number_format($totalCounter2->sum('final_total_amount'),2);
        $totalCounter3 = $this->modelObj->invoiceListData();
        $totalCounter3 = Quotation::listFilter($totalCounter3);
        $amount_counter['sgst_amount'] = number_format($totalCounter3->sum('sgst_amount'), 2);
        $totalCounter4 = $this->modelObj->invoiceListData();
        $totalCounter4 = Quotation::listFilter($totalCounter4);
        $amount_counter['igst_amount'] = number_format($totalCounter4->sum('igst_amount'), 2);
        $totalCounter5 = $this->modelObj->invoiceListData();
        $totalCounter5 = Quotation::listFilter($totalCounter5);
        $amount_counter['cgst_amount'] = number_format($totalCounter5->sum('cgst_amount'), 2);

        return Datatables::eloquent($model)
            ->editColumn('invoice_number', function ($row) {
                return '<span class="lable-table bg-primary-subtle text-primary rounded border border-primary-subtle font-text4 fw-bold">I: ' . $row->invoice_number . '</span>';
            })
            ->editColumn('final_total_amount', function ($row) {
                $html = number_format($row->final_total_amount, 2);
                if($row->is_paid)
                    $html .= '<br/><span class="lable-table bg-primary-subtle text-primary rounded border border-primary-subtle font-text2 fw-bold">Paid</span>';
                return $html;
            })
            ->editColumn('cname', function ($row) {
                return $row->cname . '<br/>' . $row->cphone;
            })
            ->editColumn('invoice_date', function ($row) {
                return date('Y, M-d', strtotime($row->invoice_date));
            })
            ->editColumn('user_id', function ($row) {
                $url = Admin::getAvtar($row->uimg);
                $html = '<img src="' . $url . '" class="rounded-circle" width="40" height="40"> &nbsp;' . $row->uname;
                return $html;
            })
            ->addColumn('action', function ($row) {
                $isEdit = (\Auth::guard('admins')->user()->user_type_id == 1)?1:0;
                return view(
                    "adminPanel.includes.actions",
                    [
                        'currentRoute' => "admin-quotations",
                        'row' => $row,
                        'isView' => 1,
                        'isPayment' => 1,
                        'isEdit' => $isEdit,
                    ]
                )->render();
            })
            ->rawColumns(['action', 'invoice_number', 'invoice_date', 'user_id', 'cname', 'final_total_amount'])
            ->filter(function ($query) {
                Quotation::listFilter($query);
            })
            ->with($amount_counter)
            ->make(true);
    }
    public function markAsPaid(Request $request)
    {
        $data = array();
        $status = 1;
        $msg = 'Marked as paid!';
        $formObj = Quotation::where('id',$request->get('invoice_id'));
        if (\Auth::guard('admins')->user()->user_type_id != 1) {
            $formObj = $formObj->where('user_id', \Auth::guard('admins')->user()->id);
        }
        $formObj = $formObj->where('is_invoice', 1)->first();

        if (!$formObj) {
            return ['status' => 0, 'msg' => 'Invoice Not Found!', 'data' => $data];
        }
        $checkValidation = Quotation::validationRulePayment($request);
        if (isset($checkValidation['status']) && $checkValidation['status'] == 0) {
            return ['status' => $checkValidation['status'], 'msg' => $checkValidation['msg'], 'data' => $checkValidation['data']];
        }
        $obj = new InvoicePayment();
        $obj->payment_date = $request->get('payment_date');
        $obj->payment_type = $request->get('payment_type');
        $obj->payment_detail = $request->get('payment_detail');
        $obj->quotation_id = $request->get('invoice_id');
        $obj->save();
        Quotation::where('id', $request->get('invoice_id'))->update(['is_paid'=>1]);

        session()->flash('success_message', "Marked as paid!");

        return ['status' => $status, 'msg' => $msg, 'data' => $data];
    }
}
