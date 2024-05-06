<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use DataTables;

class ClientsController extends Controller
{
    public function __construct()
    {
        $this->moduleRouteText = "admin-clients";
        $this->moduleViewName = "adminPanel.clients";
        $this->list_url = route($this->moduleRouteText . ".index");

        $module = "Client";
        $this->module = $module;

        $this->modelObj = new Client();
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
        $data['page_title'] = "Manage Clients";
        $data['breadcrumb'] = array('Clients' => '');
        $data['back_url'] = route($this->moduleRouteText . '.index');
        $data['add_url'] = route($this->moduleRouteText . '.create');
        $data['currentRoute'] = $this->moduleRouteText;
        return view($this->moduleViewName . ".index", $data);
    }
    public function create()
    {
        $data = array();
        $data['formObj'] = $this->modelObj;
        $data['isEdit'] = 0;
        $data['page_title'] = "Add " . $this->module;
        $data['breadcrumb'] = array('Clients' => 'admin/admin-clients', 'Add Client' => '');
        $data['action_url'] = $this->moduleRouteText . ".store";
        $data['back_url'] = $this->moduleRouteText . ".index";
        $data['action_params'] = 0;
        $data['buttonText'] = "Save";
        $data["method"] = "POST";
        $data["stateList"] = Client::stateList();
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
                $rData = $request->all();
                $rData['user_id'] = \Auth::guard('admins')->user()->id;
                $this->modelObj::create($rData);
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
        $formObj = $this->modelObj->find($id);
        if (!$formObj) {
            abort(404);
        }
        $data = array();
        $data['formObj'] = $formObj;
        $data['isEdit'] = 1;
        $data['page_title'] = "Edit " . $this->module;
        $data['breadcrumb'] = array('Clients' => 'admin/admin-clients', 'Edit Client' => '');
        $data['back_url'] = $this->moduleRouteText . ".index";
        $data['buttonText'] = "Update";
        $data['action_url'] = $this->moduleRouteText . ".update";
        $data['action_params'] = $formObj->id;
        $data['method'] = "PUT";
        $data["stateList"] = Client::stateList();
        return view($this->moduleViewName . '.add', $data);
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
                $rData = $request->all();
                $rData['user_id'] = \Auth::guard('admins')->user()->id;
                $recordId = $model->update($rData);

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
        $model = $this->modelObj->listData();
        return Datatables::eloquent($model)
            ->editColumn('company_name', function ($row) {
                $html = $row->company_name;
                if($row->gstn){
                    $html .= '<br/><span class="lable-table bg-primary-subtle text-primary rounded border border-primary-subtle font-text2 fw-bold">GSTIN: '. $row->gstn. '</span>';
                }
                return $html;
            })
            ->addColumn('phone_1', function ($row) {
                $phone = '# '. $row->phone_1;
                if($row->phone_2)
                    $phone .= '<br/># '. $row->phone_2;
                if($row->phone_3)
                    $phone .= '<br/># ' . $row->phone_3;
                return $phone;
            })
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
            ->rawColumns(['phone_1', 'action', 'company_name'])
            ->filter(function ($query) {
                $search_name = request()->get("search_name");
                $search_company = request()->get("search_company");
                $search_phone = request()->get("search_phone");
                $search_address = request()->get("search_address");
                if(!empty($search_name)) {
                    $query = $query->where("name", 'LIKE','%'.$search_name.'%');
                }
                if(!empty($search_company)) {
                    $query = $query->where("company_name", 'LIKE','%'.$search_company.'%');
                }
                if(!empty($search_phone)) {
                    $query = $query->where(function($qry) use ($search_phone){
                        $qry = $qry->where('phone_1','LIKE','%'. $search_phone.'%')
                        ->orWhere('phone_3', 'LIKE', '%' . $search_phone . '%')
                        ->orWhere('phone_2', 'LIKE', '%' . $search_phone . '%');
                    });
                }
                if(!empty($search_address)) {
                    $query = $query->where("address", 'LIKE','%'.$search_address.'%');
                }
            })
            ->make(true);
    }
    public function printAddress()
    {
        $data = array();
        $data['page_title'] = "Client's Address";
        $data['breadcrumb'] = array('Clients' => '');
        $data['clients'] = Client::all();
        return view($this->moduleViewName . ".printAddress", $data);
    }
    public function printAddressSearch(Request $request)
    {
        $search_phone = ($request->get('search_phone'))? $request->get('search_phone'):0;
        $search_name = ($request->get('search_name'))? $request->get('search_name'):0;
        $search_company = ($request->get('search_company'))? $request->get('search_company'):0;
        $data = array();
        $status = 0;
        $msg = 'Not Found!';
        $client = Client::select('*');
        if (\Auth::guard('admins')->user()->user_type_id != 1) {
            $client = $client->where('user_id', \Auth::guard('admins')->user()->id);
        }
        if($search_phone){
            $client = $client->where(function($qry)use($search_phone){
                $qry = $qry->where('phone_1','LIKE','%'. $search_phone.'%')
                ->orWhere('phone_2','LIKE','%'. $search_phone.'%')
                ->orWhere('phone_3','LIKE','%'. $search_phone.'%');
            });
        }
        if($search_name){
            $client = $client->where('name','LIKE','%'. $search_name.'%');
        }
        if($search_company){
            $client = $client->where('company_name','LIKE','%'. $search_company.'%');
        }
        $client = $client->first();
        if($client){
            $address = wordwrap($client->address, 10, "\n");
            $msg = 'Search Result';
            $status = 1;
            $data['name'] = $client->name;
            $data['phone'] = $client->phone_1;
            $data['address'] = $address;
            $data['state'] = $client->state;
            $data['city'] = $client->city;
            $data['pincode'] = $client->pincode;
            $data['company_name'] = $client->company_name;
            $data['landmark'] = $client->landmark;
        }

        return ['status' => $status, 'msg' => $msg, 'data' => $data];

    }
}
