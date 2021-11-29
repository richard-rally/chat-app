<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Chat App</a>


                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                    <li class="nav-item">
                        Logged in as: {{ user.name}} ({{ user.email}})
                    </li>
                </ul>

                <form action="logout" method="post">
                    <input type="hidden" name="_token" :value="csrf">
                    <button class="btn" >Logout</button>
                </form>
            </div>
        </nav>
        <div class="mt-5">
            <chat :user="user"></chat>
        </div>
    </div>
</template>

<script>
import Chat from "./Chat";

export default {
    name: "App",

    props: {
        user: {},
        csrf: {}
    },

    components: {
        Chat
    },
}
</script>

<style scoped>

</style>