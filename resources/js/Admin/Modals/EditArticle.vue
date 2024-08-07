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
          <h2 class="text-base font-bold">Content</h2>
            <div class="editor-container" ref="editorContainerElement">
                <ckeditor
                  :editor="editor"
                  v-model="currentArticle.content"
                  :config="editorConfig"
                  v-if="isLayoutReady"
                ></ckeditor>
              </div>
        </div>
        <div class="mb-4">
            <h2 class="text-base font-bold">Photo</h2>
            <input type="file" name="src" @change="handleFileUpload" multiple class="mb-3 w-full p-2 border rounded" />
        </div>  
        <div >
            <h2 class="text-base font-bold mt-4">Uploaded Photos</h2>
            <div class="flex flex-wrap">
              <div v-for="(photo, index) in photos" :key="index" class="relative mr-4 mb-4">
                <img :src="photo" alt="Uploaded Photo" class="w-32 h-32 object-cover rounded" />
                <button @click="removePhoto(index)" class="absolute top-0 right-0 bg-red-500 text-white p-1">x</button>
              </div>
              <div v-for="(pic, index) in currentArticle.photos" :key="index" class="relative mr-4 mb-4">
                <img :src="`/${pic}`" alt="Uploaded Photo" class="w-32 h-32 object-cover rounded" />
                <button @click="articlepage.deleteImage(index)" class="absolute top-0 right-0 bg-red-500 text-white p-1">x</button>
              </div>
            </div>
        </div>
        <div> 
            <h2 class="text-base font-bold">Type</h2>
            <select v-model="currentArticle.type" require>
                <option value="" disabled>Select type</option>
                <option value="News">News</option>
                <option value="Events">Events</option>
                <option value="Announcements">Announcements</option>
            </select>
        </div> <br>
        <div> 
            <h2 class="text-base font-bold">Status</h2>
            <select v-model="currentArticle.status" require>
                <option value="" disabled>Select status</option>
                <option value="0">Draft</option>
                <option value="1">Publish</option>
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
</template>

<script setup>
import { onMounted } from 'vue';
import { articlesStore } from '@/Admin/Stores/articlepagesStores';
import { storeToRefs } from 'pinia';
import 'bootstrap-icons/font/bootstrap-icons.css';
import {ckStore} from '@/Admin/Stores/ckeditor';

const articlepage = articlesStore();
const { currentArticle, isLayoutReady, photos} = storeToRefs(articlepage);
const ck = ckStore();
const { editor, editorConfig } = storeToRefs(ck);

onMounted(() => {
  if (articlepage.currentArticle.id) {
      articlepage.editArticleData(articlepage.currentArticle.id);
  }
});  


function handleFileUpload(event) {
  const files = event.target.files;
  for (let i = 0; i < files.length; i++) {
    const file = files[i];
    const reader = new FileReader();
    reader.onload = (e) => {
      photos.value.push(e.target.result);
    };
    reader.readAsDataURL(file);
  }
  const savedfiles = articlepage.currentArticle.photos;
  for (let i = 0; i < savedfiles.length; i++) {
    const file = savedfiles[i];
    const reader = new FileReader();
    reader.onload = (e) => {
      photos.value.push(articlepage.currentArticle.photos);
    };
    reader.readAsDataURL(file);
  }
  articlepage.handleFileUploadss(event);
}

function removePhoto(index) {
  photos.value.splice(index, 1);
  // currentArticle.photos.value.splice(index, 1);
}



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
