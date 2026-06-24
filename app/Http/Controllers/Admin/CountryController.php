<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function list()
    {
        $data = Country::orderBy('id', 'asc')->paginate(10);

        return view('admin.country.country', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create(Request $request)
    {
        $country = new Country();
        $country->name = $request->name;
        $country->save();

        return redirect()->route('country');
    }

    /**
     * Display the specified resource.
     */
    public function add()
    {
        return view('admin.country.addcountry');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $country = Country::find($id);
        return view('admin.country.editcountry', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $country = Country::find($id);
        $country->name = $request->name;
        $country->save();

        return redirect()->route('country');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $country = Country::find($id);
        $country->delete();

        return redirect()->route('country');

    }
}
