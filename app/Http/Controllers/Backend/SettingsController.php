<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Setting;
use Spatie\Valuestore\Valuestore;


class SettingsController extends Controller
{
    public function __construct()
    {
        if (\auth()->check()){
            $this->middleware('auth');
        } else {
            return view('backend.auth.login');
        }
    }



    //index

    public function index()
    {
        if (!\auth()->user()->ability('admin', 'manage_settings,show_settings')) {
            return redirect('admin/index');
        }

        $section = (isset(\request()->section) && \request()->section != '') ? 

        \request()->section : 'general';

        $settings_sections = Setting::select('section')->distinct()->pluck('section');
        
        $settings = Setting::whereSection($section)->get();

        return view('backend.settings.index', compact('section', 'settings_sections', 'settings'));

    }



    //update

    public function update(Request $request, $id)
    {
        for ($i = 0; $i < count($request->id); $i++) {

            $input['value'] = isset($request->value[$i]) ? $request->value[$i] : null;

            Setting::whereId($request->id[$i])->first()->update($input);
        }
        $this->generateCache();

        return redirect()->route('admin.settings.index')->with([

            'message' => 'تم تحديث الإعدادات بنجاح',

            'alert-type' => 'success'
        ]);
    }

    private function generateCache()
    {
        $settings = Valuestore::make(config_path('settings.json'));

        Setting::all()->each(function ($item) use ($settings) {

            $settings->put($item->key, $item->value);
        });
    }

}
