<?php





Route::group(['middleware' => ['web','auth']], function () {
     Route::get('/topics', 'Daulat\Taggy\Http\TopicController@index')->name('topics');
    Route::name('topics.')->group(function () {

     

      Route::get('in-spam', 'Daulat\Taggy\Http\TopicController@inSpam')->name('in-spam');
      Route::get('create', 'Daulat\Taggy\Http\TopicController@create')->name('create');

      Route::post('store', 'Daulat\Taggy\Http\TopicController@store')->name('store');

      Route::post('edit', 'Daulat\Taggy\Http\TopicController@edit')->name('edit');

     Route::get('/{topic}/add-tags','Daulat\Taggy\Http\TopicController@showTags')
     ->name('add-tags');
     Route::get('/{topic}/spam','Daulat\Taggy\Http\TopicController@spam')
     ->name('spam');
    Route::get('/{topic}/ham','Daulat\Taggy\Http\TopicController@ham')
     ->name('ham');

    Route::post('/{topic}/add-tags','Daulat\Taggy\Http\TopicController@addTags');

     Route::get('/{topic}/re-tags', 'Daulat\Taggy\Http\TopicController@showReTags')
     ->name('re-tags');
    Route::post('/{topic}/re-tags', 'Daulat\Taggy\Http\TopicController@reTags');

    Route::get('/{topic}/remove-all-tags', 'Daulat\Taggy\Http\TopicController@removeAllTags')->name('remove-all-tags');

  Route::get('/{topic}/remove-any-tags', 'Daulat\Taggy\Http\TopicController@removeAnyTags')->name('remove-any-tags');
  Route::post('/{topic}/remove-any-tags', 'Daulat\Taggy\Http\TopicController@removeAnyTagsPost');

    });


});

