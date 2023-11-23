// ダミーデータ

import { ref } from "vue";

export type Summary = {
    id: number;
    title: string;
};

export const articles = ref<Map<number, Summary>>(new Map());
articles.value.set(1, { id: 1, title: "Laravel + Vue3やってみる" });
articles.value.set(2, { id: 2, title: "TypeScript入門" });
articles.value.set(3, { id: 3, title: "Eloquent分析" });

