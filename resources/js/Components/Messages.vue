<template>
    <div>

        <div class="card mb-5">
            <div class="card-body">
                <h5 class="card-title">Active users</h5>
                <p class="card-text"><span :class="{'bg-primary': user.id === currentUser.id, 'bg-secondary': user.id !== currentUser.id}" class="badge rounded-pill  m-1" v-for="user in users">{{ user.name }}</span></p>
            </div>
        </div>

        <spinner :state="state"></spinner>

        <div v-if="state.complete">

            <p class="card-text" v-if="messages.length === 0">This is the start of your message history, type a message to contact your team...</p>


            <div class="card mb-3" v-for="message in messages" :class="{'text-white bg-primary': message.user.id === currentUser.id, 'bg-light' : message.user.id !== currentUser.id}">
                <div class="card-header">
                    <p class="card-text">{{ message.user.name }} ({{ message.user.email }})</p>
                </div>
                <div class="card-body">
                    <p class="card-text">{{ message.payload }}</p>
                </div>
                <div class="card-footer">
                    {{ message.created_at }}
                </div>
            </div>

            <hr>

            <create-message
                :channel="channel"
                @message-created="handleMessageCreated"
            ></create-message>

        </div>
    </div>
</template>

<script>
import CreateMessage from "./CreateMessage";
import Spinner from "./Spinner";

export default {
    name: "Messages",
    components: {Spinner, CreateMessage},
    props: {
        channel: {},
        currentUser: {},
    },

    data() {
        return {
            messages: [],
            users: [],
            state: {
                loading: false,
                complete: false,
                error: false,
            }
        }
    },

    watch: {
        channel: {
            deep: true,
            handler(newVal, oldVal) {
                this.getMessages();
                if (oldVal) {
                    this.leaveChannel(oldVal);
                }
                this.joinChannel(newVal);
            },
        }
    },

    methods: {

        joinChannel(channel) {
            window.Echo.join(`chat-channel.${channel.uuid}`)
                .here((users) => {
                    this.users = users;
                })
                .joining((user) => {
                    this.users.push(user);
                })
                .leaving((user) => {
                    this.users.splice(this.users.indexOf(user), 1);
                })
                .error((error) => {

                })
                .listen('.message.created', (e) => {
                    this.messages.push(e);
                });
        },

        leaveChannel(channel) {
            window.Echo.leave(`chat-channel.${channel.uuid}`);
        },

        getMessages() {

            this.state.loading = true

            window.axios.get(`/api/channels/${this.channel.uuid}/messages`).then(response => {
                this.messages = response.data.data;

                this.state.loading = false;
                this.state.complete = true;

            }).catch(error => {

            });
        },

        handleMessageCreated(message) {
            this.messages.push(message);
        }
    }
}
</script>

<style scoped>

</style>