<script setup lang="ts">
import { ref } from "vue";
import axios from "axios";

const getData = async () => {
    const url = "api/entries";
    let response = await axios.get(url);
    return response;
};

const entriesData: { entryId: string, title: string }[] = [];
const entries = ref(entriesData);
const entriesCount = ref(0);

getData().then(result => {
    entries.value = result.data.entries
    entriesCount.value = entries.value.length;
});


</script>

<template>
    <h1>はてなブログ一覧</h1>
    <div v-for="(entry, index) in entries">
        <span class="index">{{ entriesCount - index }}</span>
        <span>{{ entry.title }}</span>

    </div>
</template>

<style scoped>
.index {
    margin-left: 1em;
    margin-right: 1em;
}
</style>