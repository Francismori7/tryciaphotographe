<template>
    <a href="/logout" @click.prevent="logout">
        Logout
    </a>
</template>

<script>
    export default {
        methods: {
            logout() {
                axios.post('/logout', {})
                    .then(() => location.reload(true));
            }
        }
    };
</script>