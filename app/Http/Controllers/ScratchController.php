<?php

namespace App\Http\Controllers;

use App\Bet;
use App\Game;
use App\Item;
use App\Services\SteamItem;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ScratchController extends Controller
{

	const TITLE_UP = "Scratch | ";
	const GAME_PRICE = 3;

	public function scratch() {
			$bilete = \DB::table('scratch')->where('status', 0)->get();
		return view('pages.scratch',compact('bilete'));
	}


	public function buy_card(Request $request){

		$user = \DB::table('users')->where('steamid64', $this->user->steamid64)->first();
		$num = mt_rand(1,9);
if($user->money < 3){
		return response()->json(['success' => false, 'msg'=>"No money!"]);
}
		if($num <= 5 && $num > 0){
				$num = mt_rand(1,5);
				if($user->money >= 3){
					\DB::table('users')
					->where('steamid64', $this->user->steamid64)
					->update(['money' => $user->money - 3]);

						$id = \DB::table('scratch')->insertGetId(
						array('user_name' => $user->username, 'user_id' => $user->steamid64, 'join_buy' => 3, 'status' => 0, 'winning_number' => $num));
				}
						return response()->json(['success' => true, 'id' => $id, 'msg'=>"Spele izveidota", 'number' => $num]);
		}else if($num <= 7 && $num > 5 ){
				$num = mt_rand(3,7);
				if($user->money >= 3){
					\DB::table('users')
					->where('steamid64', $this->user->steamid64)
					->update(['money' => $user->money - 3]);

						$id = \DB::table('scratch')->insertGetId(
						array('user_name' => $user->username, 'user_id' => $user->steamid64, 'join_buy' => 3, 'status' => 0, 'winning_number' => $num));
				}
						return response()->json(['success' => true, 'id' => $id, 'msg'=>"Spele izveidota", 'number' => $num]);
		}else if($num <=9 && $num > 7){
				$num = mt_rand(1,7);
				if($user->money >= 3){
					\DB::table('users')
					->where('steamid64', $this->user->steamid64)
					->update(['money' => $user->money - 3]);

						$id = \DB::table('scratch')->insertGetId(
						array('user_name' => $user->username, 'user_id' => $user->steamid64, 'join_buy' => 3, 'status' => 0, 'winning_number' => $num));
				}
						return response()->json(['success' => true, 'id' => $id, 'msg'=>"Spele izveidota", 'number' => $num]);
		}

	}


public function set_stat_card(Request $request){
	$id = $request->get('id');

		$bilete = \DB::table('scratch')->where('id', $id)->first();

		if($bilete->status == 1){
				return response()->json(['success' => true, 'msg' => 'Status already changed!']);
		}else if($bilete->status == 0){
			\DB::table('scratch')
			->where('id', $id)
			->update(['status' => 1]);
			return response()->json(['success' => true, 'msg' => 'Status changed!']);
		}

}

public function set_g_e_stat($id){
	\DB::table('scratch')
	->where('id',$id)
	->update(['status' => 2]);
}

public function send_prize_win_scr($id , $mon){
	$bilete = \DB::table('scratch')->where('id', $id)->first();
		$user = \DB::table('users')->where('steamid64', $bilete->user_id)->first();
					\DB::table('users')
					->where('steamid64', $bilete->user_id)
					->update(['money' => $user->money + $mon]);

}
	public function claim_reward(Request $request) {
		$bilete = \DB::table('scratch')->where('id', $request->get('id'))->first();
	//	$b = $request->get('user');
$id = $request->get('id');
if($bilete->status == 2 || $bilete->status == 0){
	return response()->json(['success' => false, 'msg' => 'Already received coins!']);
}
		if($bilete->status == 1){

		//	console.log($bilete);
			if($bilete->winning_number == 1 && $bilete->status == 1||$bilete->winning_number == 2 && $bilete->status == 1){
						$this->set_g_e_stat($id);
						return response()->json(['success' => false, 'msg' => 'You received 0 coins!']);
			}else if($bilete->winning_number == 3 && $bilete->status == 1){
						$this->set_g_e_stat($id);
						$this->send_prize_win_scr($id, 10);
						return response()->json(['success' => true, 'msg' => 'You received 10 coins!']);
			}else if($bilete->winning_number == 4 && $bilete->status == 1){
						$this->set_g_e_stat($id);
							$this->send_prize_win_scr($id, 20);
						return response()->json(['success' => true, 'msg' => 'You received 20 coins!']);
			}else if($bilete->winning_number == 5 && $bilete->status == 1){
						$this->set_g_e_stat($id);
							$this->send_prize_win_scr($id, 30);
						return response()->json(['success' => true, 'msg' => 'You received 30 coins!']);
			}else if($bilete->winning_number == 6 && $bilete->status == 1){
						$this->set_g_e_stat($id);
							$this->send_prize_win_scr($id, 40);
						return response()->json(['success' => true, 'msg' => 'You received 40 coins!']);
			}else if($bilete->winning_number == 7 && $bilete->status == 1){
						$this->set_g_e_stat($id);
							$this->send_prize_win_scr($id, 50);
						return response()->json(['success' => true, 'msg' => 'You received 50 coins!']);
			}else if($bilete->winning_number == 8 && $bilete->status == 1){
						$this->set_g_e_stat($id);
							$this->send_prize_win_scr($id, 60);
						return response()->json(['success' => true, 'msg' => 'You received 60 coins!']);
			}else if($bilete->winning_number == 9 && $bilete->status == 1){
						$this->set_g_e_stat($id);
							$this->send_prize_win_scr($id, 70);
						return response()->json(['success' => true, 'msg' => 'You received 70 coins!']);
			}
		}


	}

}
