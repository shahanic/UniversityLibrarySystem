<template>
    <admin-layout>
        <template v-slot:main> 
            <div class="container mx-auto p-4">
                <h2>{{ pagesStore.pages.length > 0 ? pagesStore.pages[0].submenu : 'No' }} </h2>
                    <div v-if="pagesStore.pages.length">
                        <table>
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in pagesStore.pages" :key="item.id">
                                    <td style="width: 70%">{{ item.name }}</td>
                                    <td >
                                        <router-link style="padding-left: 20px" :to="{name: 'ArticlePages', params: {id: item.id}}">Preview</router-link>
                                        <button style="padding-left: 20px" @click="subnav.editPage(item)">Edit</button>
                                        <button style="padding-left: 20px" @click="subnav.deletePages(item)">Delete</button>
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
import { useRoute } from 'vue-router';
import {onMounted, ref } from 'vue';

import {pagesStores} from '@/Admin/Stores/pagesStores';
import {storeToRefs} from 'pinia';

const route = useRoute();


const pagesStore = pagesStores()
const{form} = storeToRefs(pagesStore)  

onMounted(async () => {
    const id = ref(route.params.id);
    await pagesStore.fetchPageData(id.value);
});     

pagesStore.getter();
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