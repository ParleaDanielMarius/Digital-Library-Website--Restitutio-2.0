<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    // Used for AJAX subjects multiselect
    public function subjectsSelect($search) {
        $subjects = Subject::query()->select('id', 'title')->where('title', 'LIKE', '%'. $search . '%')->get();
        return response($subjects->toJson());
    }
}
