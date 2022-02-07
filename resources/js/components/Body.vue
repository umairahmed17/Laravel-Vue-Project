<template>
    <div id="body">
        <LeftBody />
        <RightBody />
    </div>
</template>
<script>
import LeftBody from "./LeftBody.vue";
import RightBody from "./RightBody.vue";
export default {
    name: "Body",
    components: {
        LeftBody,
        RightBody,
    },
};
</script>
<style lang=""></style>
