<template>
</template>
<script>
    export default {
        name: 'Redirect',
        created() {
            const path = this.$router.currentRoute.params;
            this.$router.push(path);
        }
    };
</script>