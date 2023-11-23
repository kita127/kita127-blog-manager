<template>
    <section>
        <h1>{{ article?.title }}</h1>
    </section>

    <section>
        <template v-if="article">
            <div>
                <div>
                    <div class="head">ID</div>
                    <div class="body">{{ article.id }}</div>
                </div>
                <div>
                    <div class="head">Title</div>
                    <div class="body">{{ article.title }}</div>
                </div>
                <div>
                    <div class="head">内容</div>
                    <div>{{ article.content }}</div>
                </div>
            </div>
        </template>
    </section>
</template>

<script setup lang="ts">
import { ref } from "vue";
import { Article, articles } from "../dummy/article";

interface Props {
    id: number;
}
const props = defineProps<Props>();
const article = ref<Article | undefined>(undefined);

const reqArticleDetail = (id: number) => {
    article.value = articles.value.get(id);
};

// 初期実行
reqArticleDetail(props.id);

</script>

<style scoped>
div .head {
    color: blueviolet;
}

div .body {
    margin: 10px 10px 10px 20px;
}
</style>