<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailStoreRequest;
use App\Http\Requests\EmailUpdateRequest;
use App\Models\Email;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $emails = Email::all();

        return view('email.index', compact('emails'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('email.create');
    }

    /**
     * @param \App\Http\Requests\EmailStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmailStoreRequest $request)
    {
        $email = Email::create($request->validated());

        $request->session()->flash('email.id', $email->id);

        return redirect()->route('email.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Email $email
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Email $email)
    {
        return view('email.show', compact('email'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Email $email
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Email $email)
    {
        return view('email.edit', compact('email'));
    }

    /**
     * @param \App\Http\Requests\EmailUpdateRequest $request
     * @param \App\Models\Email $email
     * @return \Illuminate\Http\Response
     */
    public function update(EmailUpdateRequest $request, Email $email)
    {
        $email->update($request->validated());

        $request->session()->flash('email.id', $email->id);

        return redirect()->route('email.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Email $email
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Email $email)
    {
        $email->delete();

        return redirect()->route('email.index');
    }
}
