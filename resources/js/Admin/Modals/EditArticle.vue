<template>
    <div class="container mx-auto p-4">
      <h1 class="text-2xl font-bold mb-4 text-center">Edit Article</h1>
      <div class="mb-6">
        <div class="col-span-2 mb-4">
          <h2 class="text-base font-bold">Title</h2>
          <textarea type="text"
            class="form-input border border-gray-300 rounded w-full"
            v-model="currentArticle.title"
            placeholder="Title" required></textarea>
        </div>
        <div class="mb-4">
          <h2 class="text-base font-bold">Description</h2>
          <textarea type="text"
            class="form-input border border-gray-300 rounded w-full py-2 px-3"
            v-model="currentArticle.abstract"
            placeholder="Abstract"></textarea>
        </div>
        <div class="mb-4">
          <h2 class="text-base font-bold">Content</h2>
          <textarea type="text"
            class="form-input border border-gray-300 rounded w-full py-2 px-3"
            v-model="currentArticle.content"
            placeholder="Content"></textarea>
        </div>
        <div class="mb-4">
          <h2 class="text-base font-bold">Photo</h2>
          <div class="editor-container" ref="editorContainerElement">
          </div> <br>   
        <div> 
            <h2 class="text-base font-bold">Status</h2>
            <select v-model="currentArticle.status" require>
                <option value="" disabled>Select status</option>
                <option value="1">Draft</option>
                <option value="0">Publish</option>
            </select>
        </div> <br> 
        <div> 
            <h2 class="text-base font-bold">Date</h2>
            <input v-model="currentArticle.date" type="date" >
        </div> <br> 
          <form @submit.prevent="articlepage.save()">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-4">
              Save
            </button>
            <button
              @click="articlepage.cancel"
              type="button"
              class="bg-green-500 text-white px-4 py-2 rounded mt-4 ml-2"
              >
              Cancel
          </button>
          </form>
        </div>
      </div>
    </div>
</template>

<script setup>
import { onMounted } from 'vue';
import { articlesStore } from '@/Admin/Stores/articlepagesStores';
import { storeToRefs } from 'pinia';
import 'bootstrap-icons/font/bootstrap-icons.css';
// import { VDateInput } from 'vuetify/labs/VDateInput'

const articlepage = articlesStore();
const { currentArticle, } = storeToRefs(articlepage);

onMounted(() => {
  if (articlepage.currentArticle.id) {
      articlepage.editArticleData(articlepage.currentArticle.id);
  }
});  

const props = defineProps({
data: {
type: Object,
required: true
},
// isVisible: {
//     type: Boolean,
//     required: true
//   }
});
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
</style>
