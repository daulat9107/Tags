<?php

namespace Daulat\Taggy\Http;

use Daulat\Taggy\Http\Controller;
use Daulat\Taggy\Http\Requests\StoreTopicTags;
use Daulat\Taggy\Models\Tag;
use Daulat\Taggy\Models\Topic;
use Daulat\Taggy\Traits\Spam\Service\SpamServiceInterface;
use Daulat\Taggy\Traits\Spam\Spam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TopicController extends Controller
{
    public function index()
    {
        
        $topics=Topic::orderBy('updated_At','desc')->where('spam',false)->paginate(15);
        return view('taggy::topics.index')->with('topics',$topics);
    }
    public function create()
    {
        return view('taggy::topics.create');
    }
    public function store(Request $request)
    {
        $topic=new Topic;
        $topic->title=$request->title;
        $topic->slug=str_slug($request->title);
        $topic->body=$request->body;
        $topic->user()->associate($request->user());
        if($topic->isSpam()){
            $topic->spam=true;
        }
        $topic->save();
        return redirect('topics')->with('status', 'New topic created.');

    }
    public function showTags(Topic $topic){
        
        $tags=Tag::get();
        return view('taggy::topics.tags.show')
        ->with('topic',$topic)
        ->with('tags',$tags);
        
    }
    public function showReTags(Topic $topic){
        
        $tags=Tag::get();
        return view('taggy::topics.tags.show_retag')
        ->with('topic',$topic)
        ->with('tags',$tags);
        
    }
    public function addTags(StoreTopicTags $request, Topic $topic)
    {

       $topic->touch();
       $topic->tag($request->tags);

        return redirect('topics')->with('status', 'Tags updated');

    }
    public function reTags(StoreTopicTags $request, Topic $topic)
    {

       $topic->touch();
       $topic->retag($request->tags);

        return redirect('topics')->with('status', 'Tags updated');

    }
    public function removeAllTags(Topic $topic)
    {
         $topic->touch();
         $topic->untag();
        return redirect('topics')->with('status', 'Tags updated');
    }
    public function removeAnyTags(Topic $topic)
    {
        $tags=$topic->tags()->get();
        return view('taggy::topics.tags.show_tags_to_remove')
        ->with('topic',$topic)
        ->with('tags',$tags);
    }
    public function removeAnyTagsPost(StoreTopicTags $request, Topic $topic)
    {
       $topic->touch();
       $topic->untag($request->tags);

        return redirect('topics')->with('status', 'Tags updated');
    }
}
