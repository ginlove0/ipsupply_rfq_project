<template>
    <div>
        <button @click="redirectPage" class="btn btn-primary" v-if="is_admin">Create WTB</button>
    </div>
</template>


<script>

    export default {
        name: "HomePage",
        props: ['userId'],

        data() {
            return {
                is_admin: false
            }
        },

        methods: {
            checkUserRole() {
                this.userId.is_admin === 1 ? this.is_admin = true : this.is_admin = false;

            },

            redirectPage(){
                window.location.href = 'http://127.0.0.1:8000/admin/createNewList';
            }
        },

        mounted() {
            this.checkUserRole();
        }
    }
</script>

<style scoped>

</style>
