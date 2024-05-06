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
        $data['currentRoute'] = $this->moduleRouteText;
        $data['back_url'] = $this->moduleRouteText . ".index";
        return view($this->moduleViewName . ".index", $data);
    }
    public function data(Request $request)
    {
        $model = $this->modelObj->invoiceListData();
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
                $isEdit = (\Auth::guard('admins')->user()->user_type_id == 1 && $row->is_paid !=1)?1:0;
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
                $search_user = request()->get("search_user");
                $search_qn_number = request()->get("search_qn_number");
                $search_client_name = request()->get("search_client_name");
                $search_client_phone = request()->get("search_client_phone");
                $search_date = request()->get("search_date");
                if (\Auth::guard('admins')->user()->user_type_id != 1) {
                    $query = $query->where("admin_users.id", \Auth::guard('admins')->user()->id);
                }
                if (!empty($search_user)) {
                    $query = $query->where("admin_users.name", "LIKE", '%' . $search_user . '%');
                }
                if (!empty($search_qn_number)) {
                    $query = $query->where("quotations.invoice_number", "LIKE", '%' . $search_qn_number . '%');
                }
                if (!empty($search_client_name)) {
                    $query = $query->where("clients.name", "LIKE", '%' . $search_client_name . '%');
                }
                if (!empty($search_client_phone)) {
                    $query = $query->where("clients.phone_1", "LIKE", '%' . $search_client_phone . '%');
                }
                if (!empty($search_date)) {
                    $query = $query->where("quotations.invoice_date", "LIKE", '%' . date('Y-m-d', strtotime($search_date)) . '%');
                }
            })
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
