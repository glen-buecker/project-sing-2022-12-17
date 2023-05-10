<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrganizationStoreRequest;
use App\Http\Requests\OrganizationUpdateRequest;
use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $organizations = Organization::all();

        return view('organization.index', compact('organizations'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('organization.create');
    }

    /**
     * @param \App\Http\Requests\OrganizationStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrganizationStoreRequest $request)
    {
        $organization = Organization::create($request->validated());

        $request->session()->flash('organization.id', $organization->id);

        return redirect()->route('organization.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Organization $organization
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Organization $organization)
    {
        return view('organization.show', compact('organization'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Organization $organization
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Organization $organization)
    {
        return view('organization.edit', compact('organization'));
    }

    /**
     * @param \App\Http\Requests\OrganizationUpdateRequest $request
     * @param \App\Models\Organization $organization
     * @return \Illuminate\Http\Response
     */
    public function update(OrganizationUpdateRequest $request, Organization $organization)
    {
        $organization->update($request->validated());

        $request->session()->flash('organization.id', $organization->id);

        return redirect()->route('organization.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Organization $organization
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Organization $organization)
    {
        $organization->delete();

        return redirect()->route('organization.index');
    }
}
