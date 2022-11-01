<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Subject;

class AjaxController extends Controller
{
    // Checks if author exists
    public function checkAuthor($search) {
        $authors = Author::query()->select('id', 'fullname')->where('fullname', 'LIKE', '%'. $search . '%')->first();
        if($authors != null) {
            return response($authors->toJson());
        }else {
            return response("Not Found", 404);
        }
    }

    // Checks if subject exists
    public function checkSubject($search) {
        $subject = Subject::query()->select('title')->where('title', 'LIKE', '%'. $search . '%')->first();
        if($subject != null) {
            return response($subject->toJson());
        }else {
            return response("Not Found", 404);
        }
    }
}
