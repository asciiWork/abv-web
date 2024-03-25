<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quotation;
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
        /*------------ACL-----------------*/
        if (!\App\Models\ACL::isAccess()) {
            return abort(404);
        }
        /*--------------------------------*/

        $data = array();
        $data['page_title'] = "Manage Quotations";
        $data['breadcrumb'] = array('Admin Quotations' => '');
        $data['add_url'] = route($this->moduleRouteText . '.create');
        return view($this->moduleViewName . ".index", $data);
    }
    public function create()
    {
        /*------------ACL-----------------*/
        if (!\App\Models\ACL::isAccess()) {
            return abort(404);
        }
        /*--------------------------------*/

        $data = array();
        $data['formObj'] = $this->modelObj;
        $data['isEdit'] = 0;
        $data['quotation_number'] = Quotation::getQuotationNumber();
        $data['products'] = Quotation::allProducts();
        $data['page_title'] = "Add " . $this->module;
        $data['breadcrumb'] = array('Admin Users' => 'admin/admin-clients', 'Add Client' => '');
        $data['action_url'] = $this->moduleRouteText . ".store";
        $data['back_url'] = $this->moduleRouteText . ".index";
        $data['action_params'] = 0;
        $data['buttonText'] = "Save";
        $data["method"] = "POST";
        return view($this->moduleViewName . '.add', $data);
    }
    public function store(Request $request)
    {
        /*------------ACL-----------------*/
        if (!\App\Models\ACL::isAccess()) {
            return abort(404);
        }
        /*--------------------------------*/

        $data = array();
        $status = 1;
        $msg = $this->addMsg;

        $checkValidation = $this->modelObj::validationRule($request);
        if (isset($checkValidation['status']) && $checkValidation['status'] == 0) {
            return ['status' => $checkValidation['status'], 'msg' => $checkValidation['msg'], 'data' => $checkValidation['data']];
        } else {
            try {
                $this->modelObj::create($request->all());
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
        /*------------ACL-----------------*/
        if (!\App\Models\ACL::isAccess()) {
            return abort(404);
        }
        /*--------------------------------*/

        $formObj = $this->modelObj->find($id);
        if (!$formObj) {
            abort(404);
        }
        $data = array();
        $data['formObj'] = $formObj;
        $data['isEdit'] = 1;
        $data['products'] = Quotation::allProducts();
        $data['page_title'] = "Edit " . $this->module;
        $data['breadcrumb'] = array('Admin Users' => 'admin/admin-users', 'Edit User' => '');
        $data['back_url'] = $this->moduleRouteText . ".index";
        $data['buttonText'] = "Update";
        $data['action_url'] = $this->moduleRouteText . ".update";
        $data['action_params'] = $formObj->id;
        $data['method'] = "PUT";
        return view($this->moduleViewName . '.add', $data);
    }

    public function update(Request $request, $id)
    {
        /*------------ACL-----------------*/
        if (!\App\Models\ACL::isAccess()) {
            return abort(404);
        }
        /*--------------------------------*/

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
                $recordId = $model->update($request->all());

                session()->flash('success_message', $this->addMsg);
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
        /*------------ACL-----------------*/
        if (!\App\Models\ACL::isAccess()) {
            return abort(404);
        }
        /*--------------------------------*/

        $model = $this->modelObj->listData();
        return Datatables::eloquent($model)
            ->addColumn('action', function ($row) {
                return view(
                    "adminPanel.includes.actions",
                    [
                        'currentRoute' => $this->moduleRouteText,
                        'row' => $row,
                        'isEdit' => 1,
                        'isDelete' => 0,
                    ]
                )->render();
            })
            ->rawColumns(['action'])
            ->filter(function ($query) {
            })
            ->make(true);
    }
}
