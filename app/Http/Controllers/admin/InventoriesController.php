<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Product;
use DataTables;

class InventoriesController extends Controller
{
    public function __construct()
    {
        $this->moduleRouteText = "admin-inventories";
        $this->moduleViewName = "adminPanel.inventories";
        $this->list_url = route($this->moduleRouteText . ".index");

        $module = "Inventory";
        $this->module = $module;

        $this->modelObj = new Inventory();
        $this->addMsg = $module . " has been added successfully!";
        $this->updateMsg = $module . " has been updated successfully!";
        $this->deleteMsg = $module . " has been deleted successfully!";
        $this->deleteErrorMsg = $module . " can not deleted!";

        view()->share("list_url", $this->list_url);
        view()->share("moduleRouteText", $this->moduleRouteText);
        view()->share("moduleViewName", $this->moduleViewName);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $data['page_title'] = "Add " . $this->module;
        $data['breadcrumb'] = array('Inventory' => 'admin/admin-inventories', 'Add Inventory' => '');
        $data['action_url'] = $this->moduleRouteText . ".store";
        $data['back_url'] = $this->moduleRouteText . ".index";
        $data['action_params'] = 0;
        $data['buttonText'] = "Save";
        $data["method"] = "POST";
        $data["stateList"] = Product::pluck('id','product_name')->all();
        return view($this->moduleViewName . '.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
