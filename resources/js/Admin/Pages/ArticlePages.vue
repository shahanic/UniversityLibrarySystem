<script setup>
import {articlepagesStore} from '@/Admin/Stores/articlepagesStores';
import {storeToRefs} from 'pinia';
import AddArticlesModal from '@/Admin/Modals/AddArticlesModal.vue';
import { ref } from 'vue';
const article = articlepagesStore()
const{form} = storeToRefs(article)  

article.getter();

const showModal = ref(false);
const currentArticle = ref(null);  // To store the user being edited

const saveArticle = () => {
  if (currentArticle.value) {
    article.editArticle(form.value);
    article.save();
  } else {
    article.save();
  }
  showModal.value = false;  // Close the modal after saving
};

const addArticle = () => {
    currentArticle.value = null;  // Clear current user for adding a new user
  showModal.value = true;
};

const editArticle = (articlex) => {
currentArticle.value = articlex;  // Set the user to be edited
  Object.assign(form.value, articlex);  // Populate form with user data
  showModal.value = true;
};

const deleteArticle = (articlex) => {
  user.deleteArticle(articlex);
};

</script>
<!-- <template>
    <admin-layout>
        <template v-slot:main>
            <div>
                <H1>Articles</H1> 
                <p> </p>
                <td></td>
            </div>
            <div>

        <div>
            <label for="">Title: </label>
            <input type="text" v-model="form.title">
        </div>
        <div>
            <label for="">Abstract: </label>
            <input type="text" v-model="form.abstract"> 
        </div>
        <div>
            <label for="">Content: </label>
            <input type="text" v-model="form.content"> 
        </div>
        <div>
            <label for="">Status: </label>
            <input type="text" v-model="form.status"> 
        </div>
        <div>
            <button @click="article.save()" class="bg-green-700 text-black px-2 py-1 rounded mr-3" >Save</button>
            
        </div>




        <br>
        <div>
        <button @click="article.add()" class="bg-blue-700 text-black px-2 py-1 rounded mr-3">Add</button>
        </div>
    </div>
    <div>
        <table class="min-w-full border-collapse border border-gray-300">
          <thead>
            <tr class="bg-gray-500">
              <th class="border border-gray-300 text-white p-2">#</th>
              <th class="border border-gray-300 text-white p-2">Title</th>
              <th class="border border-gray-300 text-white p-2">Abstract</th>
              <th class="border border-gray-300 text-white p-2">Content</th>
              <th class="border border-gray-300 text-white p-2">Status</th>
              <th class="border border-gray-300 text-white p-2">Actions</th>
    
              </tr>
            </thead>
            <tbody>
                <tr v-for="(articlex, index) in article.articles" :key="index" class="bg-gray-700">
              <td class="border border-gray-300 text-white p-2">{{ index + 1 }}</td>
              <td class="border border-gray-300 text-white p-2">{{ articlex.title }}</td>
              <td class="border border-gray-300 text-white p-2">{{ articlex.abstract }}</td>
              <td class="border border-gray-300 text-white p-2">{{ articlex.content }}</td>
              <td class="border border-gray-300 text-white p-2">{{ articlex.status }}</td>
          
              <td class="border border-gray-300 text-white p-2 text-center">
                <button @click="article.editUser(articlex)" class="bg-yellow-500 text-black px-2 py-1 rounded mr-3">Edit</button>
                <button @click="article.deleteUser(articlex)" class="bg-red-500 text-black px-2 py-1 rounded">Delete</button>
              </td>
            </tr>
            </tbody>
        </table>
    </div>



        </template>
    </admin-layout>
</template> -->


<template>
    <admin-layout>
      <template v-slot:main>
        <div>
          <h1>Articles</h1>
          <p></p>
          <button @click="addArticle" class="bg-green-700 text-white px-2 py-1 rounded mr-3">Add New Account</button>
          
          <AddArticlesModal :isVisible="showModal" @close="showModal = false">
            <div>
              <div>
                <label for="">Title: </label>
                <input type="text" v-model="form.title">
              </div>
              <div>
                <label for="">Abstract: </label>
                <input type="text" v-model="form.abstract">
              </div>
              <div>
                <label for="">Content: </label>
                <input type="text" v-model="form.content">
              </div>
              <div>
                <label for="">Status: </label>
                <input type="text" v-model="form.status">
              </div>
              <div>
                <button @click="saveArticle" class="bg-green-700 text-white px-2 py-1 rounded mr-3">Save</button>
              </div>
            </div>
          </AddArticlesModal >
  
          <table class="min-w-full border-collapse border border-gray-300">
            <thead>
              <tr class="bg-gray-500">
                <th class="border border-white-300 text-white p-2">#</th>
                <th class="border border-white-300 text-white p-2">Title</th>
                <th class="border border-white-300 text-white p-2">Abstract</th>
                <th class="border border-white-300 text-white p-2">Content</th>
                <th class="border border-white-300 text-white p-2">Status</th>
                <th class="border border-white-300 text-white p-2">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(articlex, index) in article.articles" :key="index" class="bg-gray-700">
                <td class="border border-white-300 text-white p-2">{{ index + 1 }}</td>
                <td class="border border-white-300 text-white p-2">{{ articlex.title }}</td>
                <td class="border border-white-300 text-white p-2">{{ articlex.abstract }}</td>
                <td class="border border-white-300 text-white p-2">{{ articlex.content }}</td>
                <td class="border border-white-300 text-white p-2">{{ articlex.status }}</td>
                <td class="border border-white-300 text-white p-2 text-center">
                  <button @click="editArticle(articlex)" class="bg-yellow-400 text-black px-2 py-1 rounded mr-3">Edit</button>
                  <button @click="deleteArticle(articlex)" class="bg-red-400 text-black px-2 py-1 rounded">Delete</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </template>
    </admin-layout>
  </template>