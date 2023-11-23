<template>
    <h1>Index</h1>
    <div> {{ message }} </div>
    <p>
        <RouterLink v-bind:to="{ name: 'About' }">About</RouterLink>
    </p>
</template>
<script lang="ts" setup>
import { ref } from "vue";
import { RouterLink } from "vue-router";
const message = ref<string>('index message');
</script>
  