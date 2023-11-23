# kita127-blog-manager

自分のブログ管理アプリケーション


## description

### Initialize

```
$ make init
```

### Terminate

```
$ make down
```

### Usage

1. `.env` の以下を設定する
    1. `USER_ID`, `API_KEY`, `API_URI`
3. Initialize 実行
4. `apache` コンテナに入る
    1. `$ docker compose exec apache bash`
5. `$ npm run dev` を実行する
6.  ブラウザから `http://localhost:80` にアクセス



## Enviroment

- main branch
    - Apache
    - MySQL
    - PHP
    - Laravel
    - Vite
    - Node.js
    - xdebug
- vue branch
    - Vue.js
    - TypeScript

## Vite

フロントは更新したら `npm run build` する。
開発中は `npm run dev`。

## design

`./docs/design.md` にまとめる
