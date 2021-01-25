<?php

namespace App\Http\Controllers\AddressBook;

use App\Http\Controllers\Controller;
use App\Models\addressCustomer;
use Illuminate\Http\Request;

class addressBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('addressBook.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\addressCustomer  $addressCustomer
     * @return \Illuminate\Http\Response
     */
    public function show(addressCustomer $addressCustomer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\addressCustomer  $addressCustomer
     * @return \Illuminate\Http\Response
     */
    public function edit(addressCustomer $addressCustomer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\addressCustomer  $addressCustomer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, addressCustomer $addressCustomer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\addressCustomer  $addressCustomer
     * @return \Illuminate\Http\Response
     */
    public function destroy(addressCustomer $addressCustomer)
    {
        //
    }
}
