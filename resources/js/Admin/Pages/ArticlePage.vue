<template>
  <admin-layout>
    <template v-slot:main>
      <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4 text-center">Article Page</h1>
        <div v-if="currentArticle" class="mb-6">
          <div class="col-span-2 mb-4">
            <h2 class="text-base font-bold">Title</h2>
            <textarea type="text"
              class="form-input border border-gray-300 rounded w-full"
              v-model="currentArticle.title"
              placeholder="Title"></textarea>

          </div>
          <div class="mb-4">
            <h2 class="text-base font-bold">Abstract</h2>
            <textarea type="text"
              class="form-input border border-gray-300 rounded w-full py-2 px-3"
              v-model="currentArticle.abstract"
              placeholder="Abstract"></textarea>

          </div>
          <div class="mb-4">
            <h2 class="text-base font-bold">Content</h2>
            <form @submit.prevent="saveContent(articlex)">
              <ckeditor :editor="editor" v-model="currentArticle.content" :config="editorConfig"></ckeditor>
              <button
                type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded mt-4"
              >
                Save
              </button>
              <button
                @click="deleteArticle"
                type="button"
                class="bg-red-500 text-white px-4 py-2 rounded mt-4 ml-2"
              >
                Delete
              </button>
            </form>
          </div>
        </div>
      </div>
    </template>
  </admin-layout>
</template>

<script setup>
import { onMounted } from 'vue';
import { useRoute } from 'vue-router';
import { articlesStore } from '@/Admin/Stores/articlepagesStores';
import CKEditor from '@ckeditor/ckeditor5-vue';
import { storeToRefs } from 'pinia';

// Access the Pinia store
const articlepagestore = articlesStore();
const { editor, editorConfig, currentArticle } = storeToRefs(articlepagestore);

// route const
const route = useRoute();

// Automatically edit each article when the component is mounted
onMounted(() => {
  const id = route.params.id;  // Get ID from route params
  if (id) {
    articlepagestore.fetchArticleData(id);
  }
});

function saveContent() {
  if (currentArticle.value) {
    articlepagestore.save();
  }
}


function deleteArticle() {
  if (currentArticle.value && confirm('Are you sure you want to delete this article?')) {
    articlepagestore.deleteArticle(currentArticle.value.id);
  }
}
</script>


<style>
.container {
  width: 100%;
  padding: 100px;
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

.ck-content>ul {
    display: block;
    list-style-type: disc;
    margin-top: 1em;
    margin-bottom: 1em;
    margin-left: 0;
    margin-right: 0;
    padding-left: 40px;
}

.ck-content>ol {
    display: block;
    list-style-type: decimal;
    margin-top: 1em;
    margin-bottom: 1em;
    margin-left: 0;
    margin-right: 0;
    padding-left: 40px;
}

.ck>h1 {
    display: block;
    font-size: 2em;
    margin-top: 0.67em;
    margin-bottom: 0.67em;
    margin-left: 0;
    margin-right: 0;
    font-weight: bold;
}

.ck>h2 {
    display: block;
    font-size: 1.5em;
    margin-top: 0.83em;
    margin-bottom: 0.83em;
    margin-left: 0;
    margin-right: 0;
    font-weight: bold;
}

.ck>h3 {
    display: block;
    font-size: 1.17em;
    margin-top: 1em;
    margin-bottom: 1em;
    margin-left: 0;
    margin-right: 0;
    font-weight: bold;
}

.ck>h4 {
    display: block;
    font-size: 1em;
    margin-top: 1.33em;
    margin-bottom: 1.33em;
    margin-left: 0;
    margin-right: 0;
    font-weight: bold;
}

.ck>h5 {
    display: block;
    font-size: 0.83em;
    margin-top: 1.67em;
    margin-bottom: 1.67em;
    margin-left: 0;
    margin-right: 0;
    font-weight: bold;
}

.ck>h6 {
    display: block;
    font-size: 0.67em;
    margin-top: 2.33em;
    margin-bottom: 2.33em;
    margin-left: 0;
    margin-right: 0;
    font-weight: bold;
}
</style>
