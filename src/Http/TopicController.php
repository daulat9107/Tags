<?php

namespace Daulat\Taggy\Http;

use Daulat\Taggy\Http\Controller;
use Daulat\Taggy\Http\Requests\StoreTopicTags;
use Daulat\Taggy\Models\Tag;
use Daulat\Taggy\Models\Topic;
use Daulat\Taggy\Traits\Spam\Service\SpamServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TopicController extends Controller
{
    public function index(SpamServiceInterface $spam)
    {
        dd($spam);
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
            dd('dj');
        }
        $topic->save();
        return redirect('topics')->with('status', 'New topic created.');

    }
    public function showTags($slug ,Topic $topic){
        $topic=$topic->where('slug',$slug)->first();
        $tags=Tag::get();
        return view('taggy::topics.tags.show')
        ->with('topic',$topic)
        ->with('tags',$tags);
        
    }
    public function showReTags($slug ,Topic $topic){
        $topic=$topic->where('slug',$slug)->first();
        $tags=Tag::get();
        return view('taggy::topics.tags.show_retag')
        ->with('topic',$topic)
        ->with('tags',$tags);
        
    }
    public function addTags(StoreTopicTags $request, $slug)
    {

       $topic=Topic::find($request->topic_id);
       $topic->touch();
       $topic->tag($request->tags);

        return redirect('topics')->with('status', 'Tags updated');

    }
    public function reTags(StoreTopicTags $request, $slug)
    {

       $topic=Topic::find($request->topic_id);
       $topic->touch();
       $topic->retag($request->tags);

        return redirect('topics')->with('status', 'Tags updated');

    }
    public function removeAllTags($slug ,Topic $topic)
    {
         $topic=$topic->where('slug',$slug)->first();
         $topic->touch();
         $topic->untag();
        return redirect('topics')->with('status', 'Tags updated');
    }
    public function removeAnyTags($slug ,Topic $topic)
    {
        $topic=$topic->where('slug',$slug)->first();
        $tags=$topic->tags()->get();
        return view('taggy::topics.tags.show_tags_to_remove')
        ->with('topic',$topic)
        ->with('tags',$tags);
    }
    public function removeAnyTagsPost(StoreTopicTags $request, $slug)
    {
       $topic=Topic::find($request->topic_id);
       $topic->touch();
       $topic->untag($request->tags);

        return redirect('topics')->with('status', 'Tags updated');
    }
}
