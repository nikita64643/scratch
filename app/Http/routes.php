<?php

get('/scratch', ['as' => 'give', 'uses' => 'ScratchController@scratch']);
get('/buy_card', ['as' => 'give', 'uses' => 'ScratchController@buy_card']);
get('/claim_reward', ['as' => 'give', 'uses' => 'ScratchController@claim_reward']);
get('/set_stat_card', ['as' => 'give', 'uses' => 'ScratchController@set_stat_card']);
