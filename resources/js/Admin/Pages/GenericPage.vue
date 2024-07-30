<template>
    <admin-layout>
        <template v-slot:main> 
    
                <h2>Generic Pages</h2>
                    <div v-if="genericpages.generics.length">
                  <table class="min-w-full border-collapse border border-gray-300 shadow-lg rounded-lg">
                  <thead>
                      <tr class="bg-gray-200 text-white">
                          <th class="border border-gray-300 p-2 font-bold">Title</th>
                          <th class="border border-gray-300 p-2 font-bold">Submenu</th>
                          <th class="border border-gray-300 p-2"></th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr v-for="item in genericpages.generics" :key="item.id" class="bg-white">
                          <td class="border border-gray-300 text-gray-700 p-2" style="width: 30%">{{ item.title }}</td>
                          <td class="border border-gray-300 text-gray-700 p-2" style="width: 48%">{{ item.submenu }}</td>
                          <td class="border border-gray-300 text-center p-2">
                              <router-link :to="{ name: 'EditGenericPage', params: { id: item.id } }" class="bg-yellow-500 text-white px-3 py-2 rounded mr-3 hover:bg-blue-yellow transition duration-300"><i class="bi bi-pencil-square fw-bold "></i> </router-link>
                              <button @click="deletePage(item)" class="bg-red-400 text-white px-3 py-1.5 rounded hover:bg-red-600 transition duration-300"><i class="bi bi-trash fw-bold text-white "> </i></button>
                          </td>
                      </tr>
                  </tbody>
              </table>

              </div>
      
        </template>
    </admin-layout>
</template>


<script setup>
import { useRoute } from 'vue-router';
import { onMounted, ref } from 'vue';

import { genericpagesStore } from '@/Admin/Stores/genericpagesStores';
import { articlesStore } from '@/Admin/Stores/articlepagesStores';
import { storeToRefs } from 'pinia';

const route = useRoute();

//pages
const genericpages = genericpagesStore()
const{form, currentPage} = storeToRefs(genericpages)  

onMounted(async () => {
    const id = route.params.id;
    await genericpages.fetchPageData(id);
});     

  function deletePage() {
    if (currentPage.value && confirm('Are you sure you want to delete this page?')) {
        genericpages.deletePages(currentPage.value.id);
    }
  }

</script>


<style scoped>
.container {
  width: 100%;
  padding: 100px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
  background-color: #fff;
}

.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 10px;
}

h2 {
  margin: 0;
  font-size: 1.2em;
  font-weight: bold;
  padding-left: 7px;
  text-align: center;
}

.view-details {
  text-decoration: none;
  color: #007BFF;
  font-size: 0.9em;
}

table {
  width: 100%;
  border-collapse: collapse;
}

th, td {
  padding: 8px;
  text-align: left;
  border-bottom: 1px solid #eee;
}

th {
  font-weight: normal;
  color: #666;
}

.avatar {
  border-radius: 50%;
  width: 32px;
  height: 32px;
  margin-right: 8px;
  vertical-align: middle;
}

.leave {
  color: #FF4500;
}

.negative {
  color: #FF4500;
}

.positive {
  color: #4CAF50;
}
</style>