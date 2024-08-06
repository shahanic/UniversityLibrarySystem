<template>
      <div class="container mx-auto p-4">
        
        <h1 class="text-2xl font-bold mb-4 text-center">Edit Page</h1>
        <div v-if="currentPage" class="mb-6">
          <div class="col-span-2 mb-4">
            <h2 class="text-base font-bold">Title</h2>
            <textarea
              type="text"
              class="form-input border border-gray-300 rounded w-full"
              v-model="currentPage.title"
              placeholder="Title"
            ></textarea>
          </div>
          <div class="mb-4">
            <h2 class="text-base font-bold">Abstract</h2>
            <textarea
              type="text"
              class="form-input border border-gray-300 rounded w-full py-2 px-3"
              v-model="currentPage.abstract"
              placeholder="Abstract"
            ></textarea>
          </div>
          <div>
            <h2 class="text-base font-bold">Navigation</h2>
            <select v-model="currentPage.navigation_id" @change="genericpages.retrieveSubNavs(currentPage.navigation_id); currentPage.sub_menu_id = '' ;">
                <option value="" disabled>Select a navigation</option>
                <option v-for="nav in genericpages.navs" v-bind:key="nav.id" v-bind:value="nav.id">{{nav.menu}}</option>
              </select>
          </div><br>
          <div> 
            <h2 class="text-base font-bold">Sub Navigation</h2>
            <select v-model="currentPage.sub_menu_id">
                <option value="" disabled>Select a sub-navigation</option>
                <option v-for="subnav in genericpages.subnavs" v-bind:key="subnav.id" v-bind:value="subnav.id" >{{subnav.submenu}}</option>
              </select>
          </div> <br>
          <div> 
            <h2 class="text-base font-bold">Status</h2>
            <select v-model="currentPage.status" require>
                <option value="" disabled>Select status</option>
                <option value="1">Draft</option>
                <option value="0">Publish</option>
              </select>
          </div> <br>

          <div class="mb-4">
            <h2 class="text-base font-bold">Content</h2>
            <div class="editor-container" ref="editorContainerElement">
              <ckeditor
                :editor="editor"
                v-model="currentPage.content"
                :config="editorConfig"
                v-if="isLayoutReady"
              ></ckeditor>
            </div>
            <form @submit.prevent="savePage()">
              <button
                type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded mt-4"
              >
                Save
              </button>
              <button
                @click="genericpages.cancel"
                type="button"
                class="bg-green-500 text-white px-4 py-2 rounded mt-4 ml-2"
              >
                Cancel
              </button>
              <button
                @click="deletePage"
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



<script setup>
import { watch, onMounted } from 'vue';
import { useRoute, useRouter} from 'vue-router';
import { genericpagesStore } from '@/Admin/Stores/genericpagesStores';
import { storeToRefs } from 'pinia';
import {ckStore} from '@/Admin/Stores/ckeditor';
// import { previousRoute } from '@/Admin/admin';

// Access the Pinia store
const ck = ckStore();
const genericpages = genericpagesStore();
const { currentPage, isLayoutReady } = storeToRefs(genericpages);
const { editor, editorConfig } = storeToRefs(ck);

// route const
const route = useRoute();
const router = useRouter();


// Automatically edit each article when the component is mounted
onMounted(() => {
  if (genericpages.currentPage.id) {
      genericpages.editPageData(genericpages.currentPage.id);
  }
});

function savePage() {
  if (currentPage.value) {
    genericpages.save();
   }
}

function deletePage() {
  if (currentPage.value && confirm('Are you sure you want to delete this article?')) {
      genericpages.deletePages(currentPage.value.id);
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

</style>
