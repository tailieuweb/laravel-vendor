<?php namespace Foostart\Category\Controllers\API;

/*
|-----------------------------------------------------------------------
| CategoryAdminController
|-----------------------------------------------------------------------
| @author: Kang
| @website: http://foostart.com
| @date: 28/12/2017
|
*/

use URL, Route, Redirect;
use Illuminate\Http\Request;
use Foostart\Category\Models\LocationWards;
use Foostart\Category\Models\LocationDistricts;
use Foostart\Category\Models\LocationProvinces;
use Foostart\Category\Library\Controllers\FooController;

class LocationsController extends FooController
{

    public $obj_province = NULL;
    public $obj_district = NULL;
    public $obj_ward = NULL;

    public function __construct()
    {

        parent::__construct();
        // models
        $this->obj_province = new LocationProvinces();
        $this->obj_district = new LocationDistricts();
        $this->obj_ward = new LocationWards();

    }

    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }

    /**
     * Show list of items by key
     * @return view list of items
     * @date 27/12/2017
     */
    public function getProvinces(Request $request)
    {
        $input = $request->all();
        $input['order'] = [
          'name' => 'ASC'
        ];
        $provinces = $this->obj_province->selectItems($input);
        return $this->sendResponse($provinces, 'OK');
    }

    public function getDistricts(Request $request)
    {
        $input = $request->all();
        $input['order'] = [
            'full_name' => 'ASC'
        ];
        $districts = $this->obj_district->selectItems($input);
        return $this->sendResponse($districts, 'OK');
    }

    public function getWards(Request $request)
    {
        $input = $request->all();
        $input['order'] = [
            'full_name' => 'ASC'
        ];
        $wards = $this->obj_ward->selectItems($input);
        return $this->sendResponse($wards, 'OK');
    }


}
