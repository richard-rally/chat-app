<template>
    <div>
        <form class="row">
            <div class="col-xs-12">

                <label for="channel-name" class="form-label">Channel name:</label>
                <input v-model="name" id="channel-name" class="form-control mb-3"
                       placeholder="Start typing a message"/>
                <div class="error" v-if="errors.hasOwnProperty('name')">
                    {{ errors.name[0] }}
                </div>

                <button @click="createChannel" :disabled="! name" class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    name: "CreateChannel",

    data() {
        return {
            name: null,
            errors: {},
        }
    },

    methods: {
        createChannel() {

            this.errors = {};

            window.axios.post(`/api/channels`, {
                name: this.name
            }).then(response => {
                this.$emit('channel-created', response.data.data);
                this.name = null;
            }).catch(response => {
                this.errors = response.response.data.errors;
            });
        }
    }
}
</script>

<style scoped>

</style>