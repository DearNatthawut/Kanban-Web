<?php
/**
 * Created by PhpStorm.
 * User: DNOJ
 * Date: 3/29/2016
 * Time: 7:12 PM
 */
namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Comment;
use App\Models\Membermanagement;
use App\Models\Card;
use App\Models\Checklist;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Input;
use Validator;

date_default_timezone_set('Asia/Bangkok');

class BoardController extends Controller
{

    //แสดงข้อมูลบอร์ดในหน้าแรก
    public function showAllBoard()
    {
        if (!Auth::check()) return redirect("/");
        if (Auth::user()->Level_id == 1) return redirect('/permissions');

        $data = Board::with(['members', 'manager', 'membersManager'])
            ->select('boards.*')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.board.index')->with('allBoards', $data);
    }

    //แสดงบอร์ด
    public function showBoard($id)
    {
        if (!Auth::check()) return redirect("/");
        if (Auth::user()->Level_id == 1) return redirect('/managementAccount');

        $data = Board::find($id);
        session::put("Board", $id);  //--------------------------------------- CreateSession
        session::put("Manager", $data->manager_id);

        $memberOfBoard = Membermanagement::where('User_id','=',Auth::user()->id)
        ->where('Board_id','=',$data->id)
        ->get();
        if (count($memberOfBoard) == 0) {
          return redirect("/");
        }

        return view('pages.board.board')->with('Board', $data);
    }


    public function formCreateBoard()
    {

      if (!Auth::check()) return redirect("/");
      if (Auth::user()->Level_id == 1) return redirect('/managementAccount');
      if (Auth::user()->Level_id != 3) return redirect('/');

        return view('pages.board.createBoard');
    }

    //สร้าง Bord
    public function createBoard()
    {

        if (!Auth::check()) return redirect("/");
        if (Auth::user()->Level_id == 1) return redirect('/managementAccount');
        if (Auth::user()->Level_id != 3) return redirect('/');

        $dateEs = preg_split('[-]', \Input::get('date'));

        $Board = new Board();
        $Board->name = \Input::get('name');
        $Board->detail = \Input::get('detail');
        $Board->worklimit = \Input::get('worklimit');
        $Board->estimate_start = $dateEs[0];
        $Board->estimate_end = $dateEs[1];
        $Board->manager_id = Auth::user()->id;
        $Board->save();


        $id = $Board['id'];
        $Manager = new Membermanagement();
        $Manager->Board_id = $id;
        $Manager->User_id = Auth::user()->id;
        $Manager->save();
        return redirect('/home');
    }

    //แก้ไขบอร์ด
    public function formEditBoard($id)
    {
        if (!Auth::check()) return redirect("/");
        if (Auth::user()->Level_id == 1) return redirect('/managementAccount');

        $data = Board::all()->find($id);

        if (Auth::user()->id != $data->manager_id) return redirect("/");


        $dateFormatStart = preg_split('[-]', $data->estimate_start);
        $dateFormatStart = $dateFormatStart[0] . "/" . $dateFormatStart[1] . "/" . $dateFormatStart[2];
        $dateFormatEnd = preg_split('[-]', $data->estimate_end);
        $dateFormatEnd = $dateFormatEnd[0] . "/" . $dateFormatEnd[1] . "/" . $dateFormatEnd[2];

        if ($data->start_date != null) {
            $dateFormatStartAC = preg_split('[-]', $data->start_date);
            $dateFormatStartAC = $dateFormatStartAC[0] . "/" . $dateFormatStartAC[1] . "/" . $dateFormatStartAC[2];
        } else $dateFormatStartAC = "  ";


        if ($data->end_date != null) {
            $dateFormatEndAC = preg_split('[-]', $data->end_date);
            $dateFormatEndAC = $dateFormatEndAC[0] . "/" . $dateFormatEndAC[1] . "/" . $dateFormatEndAC[2];
        } else $dateFormatEndAC = "  ";

        $manager = Membermanagement::with(['member'])
            ->where('Board_id', '=', $id)
            ->get();

        return view('pages.board.edit')
            ->with('Board', $data)
            ->with('dateStart', $dateFormatStart)
            ->with('dateEnd', $dateFormatEnd)
            ->with('dateStartAC', $dateFormatStartAC)
            ->with('dateEndAC', $dateFormatEndAC)
            ->with('members', $manager);
    }

    public function editBoard()
    {

      if (!Auth::check()) return redirect("/");
      if (Auth::user()->Level_id == 1) return redirect('/managementAccount');

        $dateEs = preg_split('[-]', \Input::get('date'));

        $edit = Board::find(\Input::get('id'));
        if (Auth::user()->id != $edit->manager_id) return redirect("/");

        $edit->name = \Input::get('name');
        $edit->detail = \Input::get('detail');
        $edit->worklimit = \Input::get('worklimit');
        $edit->manager_id = Auth::user()->id;
        $edit->estimate_start = $dateEs[0];
        $edit->estimate_end = $dateEs[1];
        $edit->save();
        return redirect('/home');
    }


    //ซ่อน Baord
    public function deleteBoard($id)
    {

      if (!Auth::check()) return redirect("/");
      if (Auth::user()->Level_id == 1) return redirect('/managementAccount');

        $board = Board::find($id);
        if (Auth::user()->id != $board->manager_id) return redirect("/");
        $board->board_hide = 1;
        $board->save();

        return redirect('/home');
    }

    //ลบ Baord
    public function hardDeleteBoard($id)
    {

      if (!Auth::check()) return redirect("/");
      if (Auth::user()->Level_id == 1) return redirect('/managementAccount');

         $data = Board::find($id);
       if (Auth::user()->id != $data->manager_id) return redirect("/");

        $cards = Card::where('Board_id', '=', $id)
            ->get();

        $ids = [];
        foreach ($cards as $cards) {
            $ids[] = $cards['id'];
        }

        Checklist::whereIn('Card_id', $ids)
            ->delete();

        Comment::whereIn('Card_id', $ids)
            ->delete();

        Card::where('Board_id', '=', $id)
            ->whereNotNull('child_id')
            ->delete();


        Card::where('Board_id', '=', $id)
            ->delete();

       Membermanagement::where('Board_id', '=', $id)
           ->delete();


        $data->delete();

        return redirect('/home');
    }

    public function restoreBoard($id)
    {
      if (!Auth::check()) return redirect("/");
      if (Auth::user()->Level_id == 1) return redirect('/managementAccount');

        $board = Board::find($id);
        if (Auth::user()->id != $board->manager_id) return redirect("/");

        $board->board_hide = 0;
        $board->save();

        return redirect('/home');
    }

    public function boardComplete()
    {
        if (!Auth::check()) return redirect("/");
        if (Auth::user()->Level_id == 1) return redirect('/managementAccount');
        if (Auth::user()->Level_id != 3) return redirect('/');

        $board = Board::find(session()->get('Board'));
        if (Auth::user()->id != $board->manager_id) return redirect("/");
        $board->status_complete = 1;
        $board->end_date = date('Y-m-d');
        $board->save();

    }

    public function boardPostInComplete()
    {
      if (!Auth::check()) return redirect("/");
      if (Auth::user()->Level_id == 1) return redirect('/managementAccount');


        $board = Board::find(session()->get('Board'));
        if (Auth::user()->id != $board->manager_id) return redirect("/");
        $board->status_complete = 0;
        $board->end_date = null;
        $board->save();

    }


    public function getDataMember()
    {
        if (!Auth::check()) return redirect("/");
        $user = User::find(Auth::user()->id);
        $board = Board::with([])
            ->find(session()->get('Board'));

        $data['user'] = $user;
        $data['board'] = $board;
        return $data;

    }

}
