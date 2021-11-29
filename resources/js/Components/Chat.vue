<template>
    <div class="row">

        <div class="col-sm-4">

            <div class="list-group" v-if="channels.length > 0">

                <div href="#" class="list-group-item list-group-item-action" aria-current="true">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Channels</h5>
                    </div>
                </div>

                <a href="#" class="list-group-item" :class="{'active': selectedChannel && selectedChannel.uuid === channel.uuid}" v-for="channel in channels" @click="setChannel(channel)">{{ channel.name }}</a>
            </div>
            <p v-else>
                There are no channels, create one below
            </p>

            <div class="mt-3">
                <create-channel
                    @channel-created="handleChannelCreated"
                ></create-channel>
            </div>

        </div>
        <div class="col-sm-8">
            <messages
                v-show="selectedChannel !== null"
                :current-user="user"
                :channel="selectedChannel">
            </messages>
        </div>
    </div>
</template>

<script>
import Messages from "./Messages";
import CreateChannel from "./CreateChannel";

export default {
    name: "Chat",
    components: {CreateChannel, Messages},

    props: {
        user: {}
    },

    data() {
        return {
            channels: [],
            selectedChannel: null,
            channelName: null,
        }
    },

    created() {
        this.getChannels();

        window.Echo.channel('chat-channels')
            .listen('.created', (e) => {
                this.channels.push(e);
            })
    },

    methods: {

        setChannel(channel) {
            this.selectedChannel = channel;
        },

        handleChannelCreated(channel) {
            this.channels.push(channel);
        },

        getChannels() {
            window.axios.get('/api/channels').then(response => {
                this.channels = response.data.data;
            }).catch(error => {

            });
        }
    }
}
</script>

<style scoped>

</style>