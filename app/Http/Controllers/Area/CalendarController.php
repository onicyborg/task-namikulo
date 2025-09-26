<?php

namespace App\Http\Controllers\Area;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        $data['title'] = 'Calendar';
        $data['page'] = 'calendar';

        return view('area.calendar', $data);
    }
}
