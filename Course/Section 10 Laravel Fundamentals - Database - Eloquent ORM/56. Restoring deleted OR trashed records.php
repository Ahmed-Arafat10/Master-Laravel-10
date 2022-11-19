<?php
# to restore soft deleted records

Route::get('/elo_restoresoftdelete', function () {
    // function restore() will convert soft deleted records shown in the following select query into normal records
    // you can also use withTrashed() function, depends on the case
    $res = Post::onlyTrashed()->where('is_admin', 0)->restore();
    return $res;
});