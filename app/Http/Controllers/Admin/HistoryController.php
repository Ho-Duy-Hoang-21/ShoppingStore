<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\History;
class HistoryController extends Controller
{
    public function historyList()
    {
        $history = History::paginate(10);

        return view('admin.history.history',compact('history'));
    }
}
