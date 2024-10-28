<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\frontend\User_opinion;
use Mail;
use App\Mail\DeleteOpinionMail;
use App\Http\Requests\admin\OpinionReplayRequest;
use App\Mail\ReplayOpinionMail;

class ContactController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function opinion_list()
    {
        $user_opinions = User_opinion::all();
        return view('admin/opinion/opinion_list', compact('user_opinions'));
    }

    public function opinion_delete($id_opinion)
    {
        $email = User_opinion::where('id',$id_opinion)->first()->email;
        $data = [
            'subject' => 'Thông báo về việc xóa đóng góp của bạn',
            'body' => 'Rất tiếc chúng tôi phải xóa đóng góp của bạn vì nội dung chứa ngôn từ không phù hợp!',
        ];
        if(User_opinion::where('id',$id_opinion)->delete())
        {
            try
            {
                Mail::to($email)->send(new DeleteOpinionMail($data));
                return redirect('/admin/opinion_list')->with('success', __('Xóa thành công'));
            }
            catch(Exception $th)
            {
                return redirect('/admin/opinion_list')->withErrors('Xóa thất bại');
            }
        }
    }

    public function opinion_replay_form($id_opinion)
    {
        $subject = User_opinion::findOrFail($id_opinion)->subject;
        return view('admin/opinion/opinion_replay', compact('subject'));
    }

    public function opinion_replay(OpinionReplayRequest $request, $id_opinion)
    {
        $email = User_opinion::findOrFail($id_opinion)->first()->email;
        $data = [
            'subject' => $request->subject,
            'body' => $request->replay,
        ];

        try
        {
            Mail::to($email)->send(new ReplayOpinionMail($data));
            return redirect('/admin/opinion_list')->with('success', __('Gửi phản hồi thành công'));
        }
        catch(Exception $th)
        {
            return redirect('/admin/opinion_list')->withErrors('Gửi phản hồi thất bại');
        }
    }
}
