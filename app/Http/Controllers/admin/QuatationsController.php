<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quatation;

class QuatationsController extends Controller
{
    public function __construct()
    {
        $this->moduleRouteText = "quatations";
        $this->moduleViewName = "adminPanel.quatations";
        $this->list_url = route($this->moduleRouteText . ".index");

        $module = "Quatation";
        $this->module = $module;

        $this->modelObj = new Quatation();

        $this->addMsg = $module . " has been added successfully!";
        $this->updateMsg = $module . " has been updated successfully!";
        $this->deleteMsg = $module . " has been deleted successfully!";
        $this->deleteErrorMsg = $module . " can not deleted!";

        view()->share("list_url", $this->list_url);
        view()->share("moduleRouteText", $this->moduleRouteText);
        view()->share("moduleViewName", $this->moduleViewName);
    }

    public function index(Request $request)
    {
        $data = array();
        $data['page_title'] = 'Quatations';
        $data['breadcrumb'] = 'Quatations';

        $data = array();
        $data['page_title'] = "Manage Quatations";
        $data['add_url'] = route($this->moduleRouteText . '.create');
        return view($this->moduleViewName . ".index", $data);
    }
    public function create()
    {
        $data = array();
        $data['formObj'] = $this->modelObj;
        $data['page_title'] = "Add " . $this->module;
        $data['action_url'] = $this->moduleRouteText . ".store";
        $data['action_params'] = 0;
        $data['buttonText'] = "Save";
        $data["method"] = "POST";
        return view($this->moduleViewName . '.add', $data);
    }
}
