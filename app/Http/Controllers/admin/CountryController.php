<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Country;
use App\Http\Requests\admin\CountryRequest;

class CountryController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function country_list()
    {
        $countries = Country::all();
        return view('/admin/country/country_list', compact('countries'));
    }

    public function country_add_form()
    {
        $countries = Country::all();
        return view('/admin/country/country_add');
    }

    public function country_add(CountryRequest $request)
    {
        $data = $request->all();
        if(Country::create($data))
        {
            return redirect('/admin/country_list')->with('success', __('Thêm thành công'));
        }
        else
        {
            return redirect('/admin/country_list')->withErrors('Thêm thất bại');
        }
    }

    public function country_delete($id_country)
    {
        if(Country::where('id', $id_country)->delete())
        {
            return redirect('/admin/country_list')->with('success', __('Xóa thành công'));
        }
        else
        {
            return redirect('/admin/country_list')->withErrors('Xóa thất bại');
        }
    }
}
