<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use Illuminate\Support\Facades\Artisan;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\AppSetting;

class SettingsController extends Controller
{
	public function __construct()
    {
		$this->middleware('auth');
    }

    public function settings(Request $request)
    {
        $settings = AppSetting::find(1);

        if($settings==null)
            $settings= new AppSetting;

        $active_tab=$request->active_tab;

        if($active_tab==''){
            $active_tab='general-setting';
        }
        $pageTitle=_t(__('message.settings'));

        $notificationTemplates = \App\StaticData::with('mailMailable')->where('type', 'mailable')->select('label', 'value')->get();

        return view('admin.pages.settings',compact('settings','active_tab','pageTitle', 'notificationTemplates'));
    }

    public function settingsUpdates(SettingRequest $request)
    {
        purifyInputData($request);

        $setting=AppSetting::updateOrCreate(['id'=>'1'],$request->all());

        storeMediaFile($setting,$request->site_logo, 'site_logo');
        storeMediaFile($setting,$request->site_footer_logo, 'site_footer_logo');
        storeMediaFile($setting,$request->site_favicon, 'site_favicon');
        storeMediaFile($setting,$request->site_loader, 'site_loader');

        return redirect()->route('settings',['active_tab'=>'general-setting'])->withSuccess(_t(__('message.msg_updated',['name' => __('message.setting')])));
    }

    public function homepageSettings(Request $request)
    {
    	purifyInputData($request);

	    $inputs = $request->all();

        $settings=AppSetting::updateOrCreate(['id'=>'1'],$inputs);

        storeMediaFile($settings,$request->page_bg_image, 'page_bg_image');

        return redirect()->route('settings',['active_tab'=>'home-setting'])->withSuccess(_t(__('message.msg_updated',['name' => __('message.setting')])));

    }

    public function contactusSettings(Request $request)
    {
        purifyInputData($request);

        AppSetting::updateOrCreate(['id'=>'1'],$request->all());

        return redirect()->route('settings',['active_tab'=>'contact-setting'])->withSuccess(_t(__('message.msg_updated',['name' => __('message.contact')])));
    }

    public function notificationSettings(Request $request)
    {
        purifyInputData($request);

        $env = $request->ENV;
        foreach ($env as $key => $value){
            envChanges($key,$value);
        }

        AppSetting::updateOrCreate(['id'=>'1'], ['notification_settings' => json_encode($request->notification_setting)]);

        return redirect()->route('settings',['active_tab'=>'notification-setting'])->withSuccess(_t(__('message.msg_updated',['name' => __('message.notification_settings')])));
    }

    public function envChanges(Request $request)
    {

        if(ENV('IS_DEMO')){
            return redirect()->route('settings',['active_tab'=>'config-settings'])->withSuccess('Configuration setting not working on demo site.');
        }

	    $type = $request->type;

	    $env = $request->ENV;
        foreach ($env as $key => $value){
            envChanges($key, str_replace('#','',$value));
        }
        
        return redirect()->route('settings',['active_tab'=>'config-settings'])->withSuccess(_t(__('message.msg_updated',['name' => __('message.config_settings')])));
    }


    public function headfootupdate(Request $request)
    {   

        if(ENV('IS_DEMO')){
            return redirect()->route('settings',['active_tab'=>'other-settings'])->withSuccess('Other setting not working on demo site.');
        }

        AppSetting::updateOrCreate(['id'=>'1'],$request->all());

        $env = $request->ENV;
        foreach ($env as $key => $value){
            envChanges($key, str_replace('#','',$value));
        }

        return redirect()->route('settings',['active_tab'=>'other-settings'])->withSuccess(_t(__('message.msg_updated',['name' => __('message.other_settings')])));

    }

}
