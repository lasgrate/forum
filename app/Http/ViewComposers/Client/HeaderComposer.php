<?php
/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 24.09.2017
 * Time: 20:09
 */

namespace App\Http\ViewComposers\Client;

use App\Models\Theme;
use App\Models\Forum;
use Illuminate\View\View;
use Illuminate\Http\Request;


class HeaderComposer
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function compose(View $view)
    {
        $forum = Forum::find($this->request->forum_id);
        $theme = new Theme();
        $countAnswer = null;
        $data = array();
        if(auth()->check()){
            $themes = $theme->getAllAnswerThemesByClientId($forum->id, auth()->id());
            $countAnswer = count($themes);
            foreach ($themes as $theme) {
                $data[] = $theme->id;
            }
        }
        $view->with([
            'data' => $data,
            'countAnswer' => $countAnswer,
        ]);
    }
}