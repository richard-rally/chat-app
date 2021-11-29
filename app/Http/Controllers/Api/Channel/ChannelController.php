<?php

namespace App\Http\Controllers\Api\Channel;

use App\Contracts\ChannelServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreChannelRequest;
use App\Http\Requests\UpdateChannelRequest;
use App\Http\Resources\ChannelResource;
use App\Models\Channel;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    public function __construct(protected ChannelServiceContract $channelService)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return ChannelResource::collection(Channel::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreChannelRequest $request
     * @return ChannelResource
     */
    public function store(StoreChannelRequest $request)
    {
        return ChannelResource::make($this->channelService->createChannel($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Channel  $channel
     * @return ChannelResource
     */
    public function show(Channel $channel)
    {
        return ChannelResource::make($channel);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateChannelRequest $request
     * @param \App\Models\Channel $channel
     * @return ChannelResource
     */
    public function update(UpdateChannelRequest $request, Channel $channel)
    {
        return ChannelResource::make($this->channelService->updateChannel($channel, $request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Channel  $channel
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Channel $channel)
    {
        $this->channelService->deleteChannel($channel);

        return response()->json([], 204);
    }
}
