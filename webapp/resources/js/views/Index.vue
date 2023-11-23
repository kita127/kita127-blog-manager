<template>
    <h1>ブログマネージャーサービス</h1>

    <section>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>タイトル</th>
                    <th>詳細</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="[id, article] in articles">
                    <td>{{ article.id }}</td>
                    <td>{{ article.title }}</td>
                    <td>詳細内容</td>
                </tr>
            </tbody>
        </table>
    </section>

    <!--
    <p>
        <RouterLink v-bind:to="{ name: 'About' }">About</RouterLink>
    </p>
-->
</template>

<script lang="ts" setup>
import { ref } from "vue";
import { RouterLink } from "vue-router";


// ダミーデータ
type Summary = {
    id: number;
    title: string;
};

const articles = ref<Map<number, Summary>>(new Map());
articles.value.set(1, { id: 1, title: "Laravel + Vue3やってみる" });
articles.value.set(2, { id: 2, title: "TypeScript入門" });

</script>

<style scoped>
th {
    border: black 1px solid;
}

td {
    border: black 1px solid;
}
</style>