import { ref } from "vue";

export type Article = {
    id: number;
    title: string;
    content: string;
};

export const articles = ref<Map<number, Article>>(new Map());
articles.value.set(1,
    {
        id: 1,
        title: "Laravel + Vue3やってみる",
        content: "記事1の内容",
    }
);
articles.value.set(2,
    {
        id: 2,
        title: "TypeScript入門",
        content: "記事2の内容",
    }
);
articles.value.set(3,
    {
        id: 3,
        title: "Eloquent分析",
        content: "記事3の内容",
    });
