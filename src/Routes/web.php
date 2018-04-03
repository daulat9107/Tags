<?php





Route::group(['middleware' => ['web','auth']], function () {

 Route::get('/topics', 'Daulat\Taggy\Http\TopicController@index');
 Route::get('/topics/create', 'Daulat\Taggy\Http\TopicController@create')->name('topic.create');
 Route::post('/topics/store', 'Daulat\Taggy\Http\TopicController@store')->name('topic.store');
 Route::get('/topics/{slug}/add-tags','Daulat\Taggy\Http\TopicController@showTags')
 ->name('topics.add-tags');

 Route::post('/topics/{slug}/add-tags','Daulat\Taggy\Http\TopicController@addTags');

 Route::get('/topics/{slug}/re-tags', 'Daulat\Taggy\Http\TopicController@showReTags')
 ->name('topics.re-tags');

 Route::post('/topics/{slug}/re-tags', 'Daulat\Taggy\Http\TopicController@reTags');

 Route::get('/topics/{slug}/remove-all-tags', 'Daulat\Taggy\Http\TopicController@removeAllTags')->name('topics.remove-all-tags');
  Route::get('/topics/{slug}/remove-any-tags', 'Daulat\Taggy\Http\TopicController@removeAnyTags')->name('topics.remove-any-tags');
  Route::post('/topics/{slug}/remove-any-tags', 'Daulat\Taggy\Http\TopicController@removeAnyTagsPost');
});

