<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\ClientEditRequest;
class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = User::where('admin',0)->paginate('20');
        return view('admin.clients.index',compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        $client = new User();
        $client->name = $request->name;
        $client->email = $request->email;
        $client->password = bcrypt($request->password);
        $client->admin = 0;
        $client->save();
    }

    /**
     * Display the specified resource.
     *
     * @param    $client
     * @return \Illuminate\Http\Response
     */
    public function show(User $client)
    {
        return view('admin.clients.show',compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param   $client
     * @return \Illuminate\Http\Response
     */
    public function edit(User $client)
    {
        return view('admin.clients.show',compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $client
     * @return \Illuminate\Http\Response
     */
    public function update(ClientEditRequest $request,User $client)
    {
        $client->update($request->all());
        return redirect()->back()->with('success','Client Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $client)
    {
        $client->delete();
        return redirect()->back()->with('success','Client Deleted');
    }
}
