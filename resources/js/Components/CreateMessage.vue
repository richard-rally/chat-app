<template>
    <div>
        <form class="row">
            <div class="col-xs-12">
                <div class="input-group">
                    <textarea v-model="text" class="form-control mb-3" placeholder="Start typing a message"></textarea>
                    <div class="error" v-if="errors.hasOwnProperty('payload')">
                        {{ errors.payload[0] }}
                    </div>
                </div>
                <button @click.prevent="createMessage" :disabled="! text" class="btn btn-primary">Send</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    name: "CreateMessage",

    props: {
        channel: {
            type: Object,
            required: true,
        }
    },

    data() {
        return {
            text: null,
            errors: {}
        }
    },

    methods: {
        createMessage() {

            this.errors = {};

            window.axios.post(`/api/channels/${this.channel.uuid}/messages`, {
                payload: this.text
            }).then(response => {
                this.$emit('message-created', response.data.data);
                this.text = null;
            }).catch(response => {
                this.errors = response.response.data.errors;
            });
        }
    }
}
</script>

<style scoped>

</style>