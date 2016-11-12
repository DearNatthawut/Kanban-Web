<?php
/**
 * Created by PhpStorm.
 * User: DNOJ
 * Date: 4/19/2016
 * Time: 11:24 PM
 */
namespace App\Http\Controllers;
use App\Models\Board;
use App\Models\Color;
use App\Models\Member;
use App\Models\Membermanagement;
use App\Models\Card;
use App\Models\Priority;
use App\Models\Status;
use App\Models\Checklist;
use DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Input;
use Validator;
date_default_timezone_set('Asia/Bangkok');

class GanttController extends Controller
{

   public function getGantt($id){

    if (!Auth::check()) return redirect("/");

    $memberOfBoard = Membermanagement::where('User_id','=',Auth::user()->id)
    ->where('Board_id','=',$id)
    ->get();
    if (count($memberOfBoard) == 0) {
      return redirect("/");
    }

    $Board = Board::all()
        ->find($id);
    session::put("idForGantt", $id);


    $boardCards = Board::with(['members'])
        ->find(session()->get('idForGantt'));


    $cards = $boardCards->cards()->with(['memberCard.member','comments'])->get();


    return  view('pages.gantt.ganttChart')
        ->with('Board', $Board)
        ->with('Card', $cards);
}

    public function getCurrentBoardCards()
    {
        $board = Board::with(['members'])
            ->find(session()->get('idForGantt'));

        return $board->cards()->with([])->get();
    }
}
