<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhoneStoreRequest;
use App\Http\Requests\PhoneUpdateRequest;
use App\Models\Phone;
use Illuminate\Http\Request;

class PhoneController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $phones = Phone::all();

        return view('phone.index', compact('phones'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('phone.create');
    }

    /**
     * @param \App\Http\Requests\PhoneStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PhoneStoreRequest $request)
    {
        $phone = Phone::create($request->validated());

        $request->session()->flash('phone.id', $phone->id);

        return redirect()->route('phone.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Phone $phone
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Phone $phone)
    {
        return view('phone.show', compact('phone'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Phone $phone
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Phone $phone)
    {
        return view('phone.edit', compact('phone'));
    }

    /**
     * @param \App\Http\Requests\PhoneUpdateRequest $request
     * @param \App\Models\Phone $phone
     * @return \Illuminate\Http\Response
     */
    public function update(PhoneUpdateRequest $request, Phone $phone)
    {
        $phone->update($request->validated());

        $request->session()->flash('phone.id', $phone->id);

        return redirect()->route('phone.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Phone $phone
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Phone $phone)
    {
        $phone->delete();

        return redirect()->route('phone.index');
    }
}
