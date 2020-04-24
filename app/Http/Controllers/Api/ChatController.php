<?php

namespace App\Http\Controllers\Api;

use \App\Models\Chat;
use App\Http\Controllers\Api\BaseApiController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    use BaseApiController;


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $user =  $request->user();;
        $messages = Chat::where('receiver_id', $user->id)->select(['id', 'subject', 'message', 'sender_id', 'created_at'])
            ->with(['sender' => function ($query) {
                $query->select(['id', 'name']);
            }])
            ->paginate(10)->toArray();
        return $this->apiResponse($messages, '', '200');
    }

    public function archivedMessage(Request $request)
    {
        $user =  $request->user();;
        $messages = Chat::where('receiver_id', $user->id)->where('archive', 1)
            ->select(['id', 'subject', 'message', 'sender_id', 'read', 'created_at'])
            ->paginate(10)->toArray();
        return $this->apiResponse($messages, '', '200');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified  by Id
     *
     * @param \App\Chat $chat
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $user =  $request->user();
        $message = Chat::where('id', $id)->where(function ($query) use ($user) {
            return $query->where('sender_id', $user->id)
                ->orWhere('receiver_id', $user->id);
        })->select(['id', 'subject', 'message', 'read', 'archive'])->first();

        if ($message) {
            //==to make message status reade
            $message->read = 1;
            $message->save();
            return $this->apiResponse($message, '', '200');
        }
        return $this->apiResponse($message, __('Not Found'), '401');
    }

    /**
     * Set the specified  by Id
     * method=[post]
     */

    function setToArchive(Request $request)
    {
        $user = $request->user();
        $rules = [
            'id' => 'required',
        ];
        $data = $this->validate(request(), $rules, [], [
            'id' => __('id'),
        ]);

        $id = $request->id;

        $message = Chat::where('id', $id)->where('receiver_id', $user->id)->first();

        if ($message) {
            if ($message->archive == 1) {
                $message->archive = 0;
            } else {
                $message->archive = 1;
            }
            $message->save();
            return $this->apiResponse($message, '', '200');
        }
        return $this->apiResponse($message, __('Not Found'), '401');
    }


}
