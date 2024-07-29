<template>
    <admin-layout>
        <template v-slot:main> 
            <div class="container mx-auto p-4">
                <h2>Generic Pages</h2>
                    <div v-if="genericpages.allgenerics.length">
                        <table>
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Submenu</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in genericpages.allgenerics" :key="item.id">
                                    <td style="width: 30%">{{ item.title }}</td>
                                    <td style="width: 48%">{{ item.submenu }}</td>
                                    <td>
                                        <!-- <button @click="subnav.editPage(item)">Preview</button> -->
                                        <router-link style="padding-left: 20px; padding-right: 20px" :to="{name: 'EditGenericPage', params: {id: item.id}}">Edit</router-link>
                                        <!-- <button @click="deleteArticle">Delete</button> -->
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
            </div>
        </template>
    </admin-layout>
</template>


<script setup>
import { onMounted } from 'vue';
import { genericpagesStore } from '@/Admin/Stores/genericpagesStores';
import { storeToRefs } from 'pinia';


const genericpages = genericpagesStore()
const{generics} = storeToRefs(genericpages)  

onMounted(() => {
  genericpages.fetchPagesData();
}); 
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