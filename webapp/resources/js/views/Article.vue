<template>
    <h1>記事詳細</h1>

    <div>{{ props.id }}</div>
</template>

<script setup lang="ts">

interface Props {
    id: number;
}

const props = defineProps<Props>();

</script>