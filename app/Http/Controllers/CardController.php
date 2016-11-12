<?php
/**
 * Created by PhpStorm.
 * User: DNOJ
 * Date: 3/29/2016
 * Time: 7:12 PM
 */

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Membermanagement;
use App\Models\Card;
use App\Models\Priority;
use App\Models\Status;
use App\Models\Checklist;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use DB;
use Input;
use Validator;

date_default_timezone_set('Asia/Bangkok');

class CardController extends Controller
{


// get ข้อมูลการ์ดทั้งหมด ของ Board
    public function getCard()
    {
        if (!Auth::check()) return redirect("/");

        $board = Board::with(['members'])
            ->find(session()->get('Board'));

        $cards = Card::with(['checklists', 'memberCard.member', 'comments.memberComment','preCard'])
            ->where('Board_id', '=', session()->get('Board'))
            ->orderBy('id', 'desc')
            ->get();

        $status = \App\Models\Status::all('id', 'name')
            ->sortBy('id')
            ->toArray();
//-- สร้างรูปแบบ ข้อมูล
        $kanban = [];
        $kanban['columns'] = [];
        $num = 1;
        foreach ($status as $s) {   // นำ card ใส่ status
            $s['cards'] = [];
            foreach ($cards as $card) {
                if ($card->status_id == $num) {
                    $s['cards'][] = $card;
                }
            }
            $kanban['columns'][] = $s;
            $num++;
        }
        return $kanban;
    }



    public function getOneCard()
    {
        if (!Auth::check()) return redirect("/");

        $card = Card::with(['checklists', 'memberCard.member',  'comments.memberComment', 'preCard'])
            ->find(Input::get('cardId'));
        return $card;
    }



// บันทึก card
    public function createCard()
    {

        if (!Auth::check()) return redirect("/");
        if (Auth::user()->Level_id == 1) return redirect('/managementAccount');

        //return \Input::get();
        $dateEscard = preg_split('[-]', \Input::get('date'));
        $BoardId = session()->get('Board');

        $Card = new Card();
        $Card->name = \Input::get('name');
        $Card->detail = \Input::get('detail');
        $Card->color = \Input::get('color');
        $Card->estimate_start = $dateEscard[0];
        $Card->estimate_end = $dateEscard[1];
        if (!empty( \Input::get('preCard'))) {
            $Card->child_id = \Input::get('preCard');
        }
        $Card->priority_id = 1;

        $Card->status_id = \Input::get('status');
        $Card->type_id = 1;
        $Card->Board_id = session()->get('Board');
        $Card->MemberManagement_id = \Input::get('member');

        $Card->save();

        $getCard = Card::where('id', '=', $Card->id)
            ->select('id')
            ->get();

        if (\Input::get('sub') != null) {
            $sub = \Input::get('sub');
            $check = \Input::get('checkL');
            foreach ($sub as $index => $s) {
                $CheckL = new Checklist();
                $CheckL->Card_id = $getCard[0]->id;
                $CheckL->name = $s;
                $CheckL->status = $check[$index];
                $CheckL->save();
            }
        }
        $BoardCheckStart = Board::all()
            ->find($BoardId);
        if ($BoardCheckStart->start_date == null) {
            $BoardCheckStart->start_date = date('Y-m-d');
            $BoardCheckStart->save();
        }
        return redirect("/board/$BoardId#/");
    }


    // form สร้างการ์ด
    public function formNewCard($id)
    {

      if (!Auth::check()) return redirect("/");
      if (Auth::user()->Level_id == 1) return redirect('/managementAccount');

      $Board = Board::all()
          ->find($id);

         if (Auth::user()->id != $Board->manager_id) return redirect("/");

        $status = Status::all('id', 'name')
            ->sortBy('id')
            ->toArray();
        $prior = Priority::all('id', 'name')
            ->sortBy('id')
            ->toArray();

        $member = Membermanagement::with(['member'])
            ->where('Board_id', '=', session()->get('Board'))
            ->get();

        $getcard = Card::
            where('Board_id', '=', session()->get('Board'))
            ->get();

        return view('pages.card.createCard')
            ->with('piority', $prior)
            ->with('member', $member)
            ->with('status', $status)
            ->with('Board', $Board)
            ->with('Card', $getcard);
    }

    // แก้ไข card
    public function editFormCard($id, $card)
    {

        if (!Auth::check()) return redirect("/");
        if (Auth::user()->Level_id == 1) return redirect('/managementAccount');

        $Board = Board::all()
            ->find($id);
        if (Auth::user()->id != $Board->manager_id) return redirect("/");

        $prior = Priority::all('id', 'name')
            ->sortBy('id')
            ->toArray();

        $member = Membermanagement::with(['member'])
            ->where('Board_id', '=', $id)
            ->get();

        $getcard = Card::with(['checklist', 'memberCard.member'])
            ->where('id', '=', $card)
            ->get();


        return view('pages.card.editCard')
            ->with('Board', $Board)
            ->with('piority', $prior)
            ->with('member', $member)
            ->with('Card', $getcard);
    }

    public function editCard($id)
    {

        if (!Auth::check()) return redirect("/");
        $card = Card::with(['checklists', 'memberCard.member', 'comments.memberComment'])
            ->find($id);
        $card->fill(Input::all());
        $card->save();

        $card = Card::with(['checklists', 'memberCard.member', 'comments.memberComment','preCard'])
            ->find($id);

        return $card;

    }


    //ย้าย Card
    public function moveCard()
    {

        if (!Auth::check()) return redirect("/");

        $cardId = Input::get('cardId');
        $columnName = Input::get('columnName');

        if (strcmp($columnName, "Backlog") == 0) $column = 1;
        else if (strcmp($columnName, "Ready") == 0) $column = 2;
        else if (strcmp($columnName, "Doing") == 0) $column = 3;
        else if (strcmp($columnName, "Done") == 0) $column = 4;

        $move = Card::find($cardId);
        $move->status_id = $column;

        if ($move->date_start == null) {
            $move->date_start = date('Y-m-d');
        }
        if (($move->date_end == null && $column == 4) || $column == 4) {
            $move->date_end = date('Y-m-d');
            $move->status_complete = 1;
        }
        $move->save();

        $getCheckPre = Card::where('child_id','=',$cardId)
        ->get();
        foreach ($getCheckPre as $getPre){
             if ($getPre->status_complete == 1){
                 $getPre->status_complete = 0;

             }
            if ($getPre->status_id != 1){
                $getPre->status_id =1 ;
                $newComment = new Comment();
                $newComment->detail = "(แก้ไข โดย ".$getPre->name.")";
                $newComment->edit_status = 1 ;
                $newComment->Card_id = $getPre->id;
                $newComment->User_id = Auth::user()->id;
                $newComment->save();
            }
            $getPre->save();
        }

        $card = Card::with(['checklists', 'memberCard.member',  'comments.memberComment', 'preCard'])
            ->find($cardId);

        return $card;
    }

    public function getCardEditData()//---------------------For Detail Card controller*****************************
    {

        if (!Auth::check()) return redirect("/");

        $prior = Priority::all('id', 'name');

        $member = Membermanagement::with(['member'])
            ->where('Board_id', '=', session()->get('Board'))
            ->get();
        $user = User::find(Auth::user()->id);

        $boardManager = Board::find(session()->get('Board'));

        $data['priority'] = $prior;
        $data['manager'] = $member;
        $data['user'] = $user;
        $data['boardManager'] = $boardManager;

        return $data;
    }


    //  ลบ Card
    public function removeCard()
    {

        if (!Auth::check()) return redirect("/");

        $reCard = Card::find($cardId);
        $board = Board::find($reCard->Board_id);
      if (Auth::user()->id != $Board->manager_id) return redirect("/");

        $cardId = Input::get('card');
        $check = Checklist::where('Card_id', '=', $cardId);
        $check->delete();
        $com = Comment::where('Card_id', '=', $cardId);
        $com->delete();

        $reCard->delete();
        return $cardId;
    }

//-------------------------------------------------------------------Checklist
    public function changeCheckStatus($id)
    {

        if (!Auth::check()) return redirect("/");

        $check = Checklist::find($id);
        $check->fill(Input::all());
        $check->save();
        $card = Card::with(['checklists', 'memberCard.member',  'comments.memberComment','preCard'])
            ->find($check['Card_id']);

        return $card;

    }

    public function addNewChecklist($id)
    {

        if (!Auth::check()) return redirect("/");

        $newChecklist = new Checklist();
        $newChecklist->name = Input::get('name');
        $newChecklist->Card_id = $id;
        $newChecklist->save();

        $card = Card::with(['checklists', 'memberCard.member',  'comments.memberComment','preCard'])
            ->find($id);

        return $card;

    }

    public function updateChecklist($id)
    {

        if (!Auth::check()) return redirect("/");

        $check = Checklist::find($id);
        $check->fill(Input::all());
        $check->save();
        $card = Card::with(['checklists', 'memberCard.member', 'comments.memberComment','preCard'])
            ->find($check['Card_id']);

        return $card;

    }

    public function removeChecklist($cardID, $checklistID)
    {

        if (!Auth::check()) return redirect("/");

        $delChecklist = Checklist::where('id', '=', $checklistID);
        $delChecklist->delete();

        $card = Card::with(['checklists', 'memberCard.member', 'comments.memberComment','preCard'])
            ->find($cardID);

        return $card;

    }

    //---------------------------------------------------------------------------------------------------Comment

    public function addNewComment($id)
    {

        if (!Auth::check()) return redirect("/");

        $newComment = new Comment();
        $newComment->detail = Input::get('detail');
        $newComment->Card_id = $id;
        $newComment->User_id = Auth::user()->id;
        $newComment->save();

        $card = Card::with(['checklists', 'memberCard.member',  'comments.memberComment','preCard'])
            ->find($id);

        return $card;

    }

    public function addNewCommentMoveAllBack($id)  // ----------------------------- Add Comment event Move Card Back
    {

        if (!Auth::check()) return redirect("/");

        $newComment = new Comment();
        $newComment->detail = "(แก้ไข)(".Input::get('before')."  To  ".Input::get('before').") " . Input::get('detail');
        $newComment->edit_status = 1 ;
        $newComment->Card_id = $id;
        $newComment->User_id = Auth::user()->id;
        $newComment->save();

        $card = Card::find($id);
        $card->type_id = 2 ;
        $card->status_complete = 0;
        $card->save();

        $card->Board_id;
        $getAllCards = Card::where('Board_id','=',$card->Board_id)
            ->get();

        foreach ($getAllCards as $getCard){
            if ( $getCard->status_id != 1 && $getCard->id != $id){
                $getCard->status_id = 1;
                $getCard->type_id = 2 ;
                $getCard->save();

                $newComment = new Comment();
                $newComment->detail = "(แก้ไข โดย ".$card->name.")(".Input::get('before')."  To  ".Input::get('before').") " . Input::get('detail');
                $newComment->edit_status = 1 ;
                $newComment->Card_id = $getCard->id;
                $newComment->User_id = Auth::user()->id;
                $newComment->save();
            }

        }

    }

    public function addNewCommentMoveBack($id)  // ----------------------------- Add Comment event Move Card Back
    {

        if (!Auth::check()) return redirect("/");

        $newComment = new Comment();
        $newComment->detail = "(แก้ไข)(".Input::get('before')."  To  ".Input::get('after').") " . Input::get('detail');
        $newComment->edit_status = 1 ;
        $newComment->Card_id = $id;
        $newComment->User_id = Auth::user()->id;
        $newComment->save();

        $card = Card::find($id);
        $card->type_id = 2 ;
        $card->status_complete = 0;
        $card->save();



    }

    public function updateComment($id)
    {

        if (!Auth::check()) return redirect("/");

        $com = Comment::find($id);
        $com->fill(Input::all());
        $com->save();
        $card = Card::with(['checklists', 'memberCard.member',  'comments.memberComment','preCard'])
            ->find($com['Card_id']);

        return $card;

    }

    public function removeComment($commentID,$cardID)
    {

        if (!Auth::check()) return redirect("/");

        $delChecklist = Comment::where('id', '=', $commentID);
        $delChecklist->delete();

       $card = Card::with(['checklists', 'memberCard.member', 'comments.memberComment','preCard'])
            ->find($cardID);

        return $card;

    }

}
