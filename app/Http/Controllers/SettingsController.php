<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings=Settings::find(1);


        return view('settings.settings',compact('settings'));
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


        $site_logo='';

        if ($request->hasFile('site_logo')) {
            $image = $request->file('site_logo');
            $site_logo = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/site_logos');
            $image->move($destinationPath, $site_logo);
        }
        else{
            $site_logo=$request->old_site_logo;
        }

        $site_favicon='';
        if ($request->hasFile('site_favicon')) {
            $image = $request->file('site_favicon');
            $site_favicon = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/site_favicons');
            $image->move($destinationPath, $site_favicon);
        }
        else{
            $site_favicon=$request->old_site_favicon;
        }

        if(Settings::find(1)!=null){

        $settings=Settings::find(1);
        $settings->site_title=$request->site_title;
        $settings->site_description=$request->site_description;
        $settings->site_logo=$site_logo;
        $settings->site_favicon=$site_favicon;

        }
        else{
        $settings=new Settings();
        $settings->site_title=$request->site_title;
        $settings->site_description=$request->site_description;
        $settings->site_logo=$site_logo;
        $settings->site_favicon=$site_favicon;

        }

        $settings->save();

        return redirect('settings/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function show(Settings $settings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function edit(Settings $settings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Settings $settings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function destroy(Settings $settings)
    {
        //
    }
}
