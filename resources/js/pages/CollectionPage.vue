<template>
    <DisplayModelList :user-id="this.userId"></DisplayModelList>
</template>

<script>
    import DisplayModelList from "../components/DisplayModelList";
    export default {
        name: "CollectionPage",
        props: ['userId'],
        components: {DisplayModelList}
    }
</script>

<style scoped>

</style>
