<?php

namespace App\Http\Controllers\Api\Channel\Message;

use App\Contracts\MessageServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMessageRequest;
use App\Http\Resources\MessageResource;
use App\Models\Channel;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function __construct(protected MessageServiceContract $messageService)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request, Channel $channel)
    {
        return MessageResource::collection($channel->messages()->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreMessageRequest $request
     * @param Channel $channel
     *
     * @return MessageResource
     */
    public function store(StoreMessageRequest $request, Channel $channel)
    {
        return MessageResource::make($this->messageService->createMessage($channel, $request->user(), $request->validated()));
    }
}
