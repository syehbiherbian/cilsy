<?php

namespace App\Http\Controllers\Web\Members;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use Validator;
use Redirect;
use App\members;
use App\reward;
use App\reward_category;
use App\member_reward;
use Session;
use Hash;
use DateTime;
use DB;
class RewardController extends Controller
{
    public function index()
    {
        if (empty(Session::get('memberID'))) {
            return redirect('member/signin');
        }
        $uid = Session::get('memberID');
        $now = new DateTime;
        $date = date_format($now,'Y-m-d');
        $contrib= members::where('id',$uid)->first();
        $category =reward_category::where('enable',1)->get();
        $reward = reward::where('enable',1)->where('reward_in','!=',2)->where('end','>=',$date )->where('limit','>',0)->get();
        $myreward = member_reward::join('reward','member_reward.reward_id','=','reward.id')
                    ->select('reward.*','member_reward.id as myid')
                    ->where('reward.end','>=',$date )->get();
        return view('web.members.reward',[
            'contrib'=>$contrib,
            'category'=>$category,
            'reward'	=>$reward,
            'myreward'=>$myreward,
        ]);
    }

    public function detail($id){
        if (empty(Session::get('memberID'))) {
             return redirect('member/signin');
        }
        $uid = Session::get('memberID');
        $now = new DateTime;
        $date = date_format($now,'Y-m-d');
        $contrib= members::where('id',$uid)->first();
        // $category =reward_category::where('enable',1)->get();
        $row = member_reward::join('reward','member_reward.reward_id','=','reward.id')
                    ->select('reward.*','member_reward.id as myid')
                    ->where('member_reward.id',$id)->first();
        // $row = contributor_reward::where('id',$id)->first();
        if ($row==null) {
            return redirect('member/rewards')->with('no-processing','Reward tidak ditemukan');
        }
        return view('web.members.reward-detail',[
            'contrib'=>$contrib,
            'date_now'=>$date,
            // 'category'=>$category,
            'row'	=>$row,
        ]);
    }

    public function change($id)
    {
        if (empty(Session::get('memberID'))) {
            return redirect('member/signin');
        }

        # code...
        $memberID = Session::get('memberID');
        $now = new DateTime;
        $date = date_format($now,'Y-m-d');
        $reward = reward::where('enable',1)->where('reward_in','!=',2)->where('end','>=',$date )->where('limit','>',0)->where('slug',$id)->first();
        $contrib= members::where('id',$memberID)->first();
        if($reward==null){
            return redirect('member/rewards')->with('no-processing','Reward tidak ditemukan');
        }
        if($contrib->points < $reward->poin){
            return redirect('member/rewards')->with('no-processing','Point anda tidak mencukupi untuk reward ini!');
        }

        return view('web.members.change',[
            'reward'=>$reward
        ]);

    }

    public function doChange($id)
    {
        if (empty(Session::get('memberID'))) {
            return redirect('member/signin');
        }

        # code...
        $memberID = Session::get('memberID');
        $now = new DateTime;
        $date = date_format($now,'Y-m-d');
        $reward = reward::where('enable',1)->where('reward_in','!=',2)->where('end','>=',$date )->where('limit','>',0)->where('slug',$id)->first();
        $contrib= members::where('id',$memberID)->first();
        if($reward==null){
            return redirect('member/rewards')->with('no-processing','Reward tidak ditemukan');
        }
        if($contrib->points < $reward->poin){
            return redirect('member/rewards')->with('no-processing','Point anda tidak mencukupi untuk reward ini!');
        }

        $store = new member_reward;
        $store->member_id  = $memberID;
        $store->reward_id  = $reward->id;
        $store->status      = 0;
        $store->created_at  = $now;
        $store->save();

        $poin_update = members::find($memberID);
        $poin_update->points = $contrib->points - $reward->poin;
        // $poin_update->updated_at  = $now;
        $poin_update->save();

        $reward_update = reward::find($reward->id);
        $reward_update->limit =$reward->limit - 1 ;
                // $poin_update->updated_at  = $now;
        $reward_update->save();


     return redirect('member/rewards')->with('success','Point berhasil di tukar dengan reward ini!');
    }
}
