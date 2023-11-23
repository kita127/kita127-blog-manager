<template>
    <h1>Aoubt</h1>
    <div>{{ message }}</div>
</template>
<script lang="ts" setup>
import { ref } from "vue";
const message = ref<string>("about message");
</script>
