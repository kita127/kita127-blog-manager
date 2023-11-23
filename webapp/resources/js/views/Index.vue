<template>
    <h1>Index</h1>
    <div>
        <router-link to="/about">About</router-link>
    </div>
    <div> {{ message }} </div>
</template>
<script lang="ts" setup>
import { ref } from "vue";
const message = ref<string>('index message');
</script>
  