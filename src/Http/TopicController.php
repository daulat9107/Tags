<?php

namespace Daulat\Taggy\Http;

use Daulat\Taggy\Http\Controller;
use Daulat\Taggy\Models\Tag;
use Daulat\Taggy\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function index(Request $request)
    {

          $topics=Topic::paginate(15);

        return view('taggy::topics.index')->with('topics',$topics);

    }
}
