<?php

namespace Xcms\Themes\Http\Controllers;

use Illuminate\Http\Request;
use Xcms\Base\Http\Controllers\SystemController;
use Xcms\Themes\Facades\ThemeFacade as Theme;
use Xcms\Settings\Models\Setting;

class ThemeController extends SystemController
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware(function (Request $request, $next) {

            menu()->setActiveItem('themes');

            $this->breadcrumbs->addLink('插件与模板')->addLink('模板列表', route('themes.index'));

            return $next($request);
        });

    }

    public function index()
    {
        $this->setPageTitle('模板管理');
        $currTheme = Theme::getActive();

        return view('themes::index', compact('currTheme'));
    }

    public function update(Request $request)
    {
        $theme = $request->theme;
        Theme::setActive($theme);
        Setting::where('name', 'theme')->update(['value' => $theme]);

        return redirect()->route('themes.index')->with('success_msg', '更换主题成功');
    }
}
