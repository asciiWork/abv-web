<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Admin;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\UserAddresses;
use DataTables;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->moduleRouteText = "admin-users";
        $this->moduleViewName = "adminPanel.users";
        $this->list_url = route($this->moduleRouteText . ".index");

        $module = "User";
        $this->module = $module;

        $this->modelObj = new Admin();
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
        if(!\App\Models\ACL::isAccess()){return abort(404);}
        /*--------------------------------*/
        
        $data = array();
        $data['page_title'] = "Manage Admin Users";
        $data['breadcrumb'] = array('Admin Users' => '');
        $data['userData'] = Admin::select('*')->get();;
        $data['add_url'] = route($this->moduleRouteText . '.create');
        $data['currentRoute'] = $this->moduleRouteText;
        return view($this->moduleViewName . ".index", $data);
    }
    public function create()
    {
        /*------------ACL-----------------*/
        if(!\App\Models\ACL::isAccess()){return abort(404);}
        /*--------------------------------*/

        $data = array();
        $data['formObj'] = $this->modelObj;
        $data['isEdit'] = 0;
        $data['page_title'] = "Add " . $this->module;
        $data['breadcrumb'] = array('Admin Users' => 'admin/admin-users', 'Add User' => '');
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
        if(!\App\Models\ACL::isAccess()){return abort(404);}
        /*--------------------------------*/

        $data = array();
        $status = 1;
        $msg = $this->addMsg;

        $checkValidation = $this->modelObj::validationRule($request);
        if (isset($checkValidation['status']) && $checkValidation['status'] == 0) {
            return ['status' => $checkValidation['status'], 'msg' => $checkValidation['msg'], 'data' => $checkValidation['data']];
        } else {
            try {
                $mainData['name'] = $request->get('name');
                $mainData['email'] = $request->get('email');
                $mainData['password'] = bcrypt($request->get('password'));
                $mainData['phone'] = $request->get('phone');
                $mainData['user_type_id'] = 2;
                $image = $request->file('image');
                $profile_image = '';
                if (!empty($image)) {
                    $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'users';
                    $image_name = $image->getClientOriginalName();
                    $extension = $image->getClientOriginalExtension();
                    $image_name = md5($image_name);
                    $profile_image = $image_name . '.' . $extension;
                    $file = $image->move($destinationPath, $profile_image);
                }
                $mainData['image'] = $profile_image;
                $recordId = $this->modelObj::create($mainData);
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
        if(!\App\Models\ACL::isAccess()){return abort(404);}
        /*--------------------------------*/

        $formObj = $this->modelObj->find($id);
        if (!$formObj) {
            abort(404);
        }
        $data = array();
        $data['formObj'] = $formObj;
        $data['isEdit'] = 1;
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
        if(!\App\Models\ACL::isAccess()){return abort(404);}
        /*--------------------------------*/

        $model = $this->modelObj->find($id);
        $data = array();
        $status = 1;
        $msg = $this->updateMsg;

        $checkValidation = $this->modelObj::validationRule($request, $id);

        if (!$model) {
            $status = 0;
            $msg = "Record not found !";
        } else if(isset($checkValidation['status']) && $checkValidation['status'] == 0) {
            return ['status' => $checkValidation['status'], 'msg' => $checkValidation['msg'], 'data' => $checkValidation['data']];
        } else {
            
            try {
                $mainData['name'] = $request->get('name');
                $mainData['email'] = $request->get('email');
                $mainData['status'] = $request->get('status');
                $mainData['phone'] = $request->get('phone');
                $image = $request->file('image');
                $profile_image = '';
                if (!empty($image)) {
                    $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'users';
                    $image_name = $image->getClientOriginalName();
                    $extension = $image->getClientOriginalExtension();
                    $image_name = md5($image_name);
                    $profile_image = $image_name . '.' . $extension;
                    $file = $image->move($destinationPath, $profile_image);
                }
                $mainData['image'] = $profile_image;
                $recordId = $model->update($mainData);

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
        if(!\App\Models\ACL::isAccess()){return abort(404);}
        /*--------------------------------*/

        $model = $this->modelObj->listData();
        return Datatables::eloquent($model)
            ->addColumn('status', function ($row) {
                if($row->status)
                return '<span class="badge bg-primary">Active</span>';
                else
                return '<span class="badge bg-danger">Inactive</span>';
            })
            ->addColumn('image', function ($row) {
                $url = Admin::getAvtar($row->image);
                return '<img src="'.$url.'" alt="table-user" width="30" height="30" class="me-2 rounded-circle">';
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
            ->rawColumns(['status', 'action','image'])
            ->filter(function ($query) {
            })
            ->make(true);
    }
}