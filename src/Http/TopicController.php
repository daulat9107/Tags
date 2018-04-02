<?php

namespace Daulat\Taggy\Http;
use Illuminate\Http\Request;
use Daulat\Taggy\Models\Tag;
use Daulat\Taggy\Models\Topic;
use App\Http\Controllers\Controller;
class TopicController extends Controller
{
    public function index(Request $request)
    {
          $topic= new Topic;
          $topic->title="topic any";
          $topic->save();
          $topic->tag(['orange']);
    }
}
