<?php

namespace App\Http\Controllers;

use App\Application;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\ApplicationRequest;
use App\Http\Requests\ApplicationEditRequest;
class ClientApplicationController extends Controller
{

    public function create(User $client)
    {
        return view('admin.application.create',compact('client'));
    }

    public function store(ApplicationRequest $request, User $client)
    {
        $app = new Application();
        $app->client_id = $client->id;
        $app->anon_slug = $client->generateProjectSlug($request->name);
        $app->project_type = $request->project_type;
        $app->distribution_link = "";
        $app->save();
        return redirect()->back()->with('success','Application Created');
    }

    public function edit(User $client, Application $app)
    {
        return view('admin.application.edit',compact('client','app'));
    }

    public function update(ApplicationEditRequest $request, User $client, Application $app)
    {
        $app->update($request->all());
        return redirect()->back()->with('success','Application Updated');
    }

    public function destroy(Application $app)
    {
        $app->delete();
        return redirect()->back()->with('success','Application Deleted');
    }
}
