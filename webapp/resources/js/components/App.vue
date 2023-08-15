<script setup lang="ts">
import { ref } from "vue";
import axios from "axios";

const name = ref("田中太郎");

const getData = async () => {
    const url = "api/entries";
    let response = await axios.get(url);
    return response;
};

const entriesData: { entryId: string, title: string }[] = [];
const entries = ref(entriesData);

getData().then(result => { entries.value = result.data.entries });


</script>

<template>
    <h1>こんにちは!{{ name }}さん!</h1>
    <div v-for="(entry, index) in entries">
        {{ entry.entryId }} : {{ entry.title }}
    </div>
</template>