<?php

namespace App\Http\Controllers\Admin;

use App\Traits\UploadAble;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class SettingController extends BaseController
{
    use UploadAble;
    
    public function index()
    {
        $this->setPageTitle('Settings', 'Manage Settings');
        return view('admin.settings.index');
    }

    public function update(Request $request)
    {
        
    }
}
