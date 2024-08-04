<template>
    <div v-if="previewArticle" class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4 text-center">Preview Page</h1>
        <strong><p>{{ previewArticle.title }}</p></strong>
        <p v-html="previewArticle.content"></p>
    </div>
    <button
        @click="articlepage.cancel"
        type="button"
        class="bg-green-500 text-white px-4 py-2 rounded mt-4 ml-2"
        >
        OK
    </button>
</template>


<script setup>
import { articlesStore } from '@/Admin/Stores/articlepagesStores';
import { storeToRefs } from 'pinia';
const articlepage = articlesStore();
const { previewArticle } = storeToRefs(articlepage);
</script>

<style>
.container {
width: 100%;
padding: 50px;
box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
border-radius: 8px;
background-color: #fff;
}

h1 {
margin: 0;
font-size: 1.2em;
font-weight: bold;
padding-left: 7px;
text-align: center;
}

h2 {
margin: 0;
font-size: 1.2em;
font-weight: bold;
padding-left: 7px;
text-align: left;
}

</style>
