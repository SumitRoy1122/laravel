<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class changeLanguageController extends Controller
{
    function index(request $request)
    {
        $prevUrl = !empty(url()->previous())?explode('/',url()->previous()):'';
        $dir    = resource_path('lang');
        $filesLang = array_diff(scandir($dir), array('..', '.'));
        $currentLang = $request->lang;
        $newArrurlSec = array();
        if(!empty($prevUrl))
        {
            foreach($prevUrl as $urlsections)
            {
                if(!in_array($urlsections,$filesLang))
                {
                    $newArrurlSec[] = $urlsections;
                }else{
                    $newArrurlSec[] = $currentLang;
                }
            }
        }

        $newUrl = implode('/',$newArrurlSec);
        return redirect($newUrl);
        
    }
}
