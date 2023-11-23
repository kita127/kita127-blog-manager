<template>
    <h1>Index</h1>
    <router-link to="/about">About</router-link>
    {{ message }}
</template>
<script lang="ts">
import { defineComponent, ref } from "vue";

export default defineComponent({
    setup() {
        const message = ref<string>("Yellow");
        return {
            message
        };
    }
});
</script>
  