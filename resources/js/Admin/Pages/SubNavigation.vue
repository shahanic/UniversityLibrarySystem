<template>
    <admin-layout>
        <template v-slot:main> 
            <div class="container mx-auto p-4">
                <h2> {{ subnav.sub_menus.length > 0 ? subnav.sub_menus[0].menu : 'No' }} Navigation List</h2>
                    <div v-if="subnav.sub_menus.length">
                        <table >
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in subnav.sub_menus" :key="item.id">
                                    <td  style="width: 70%">{{ item.submenu }}</td>
                                    <td>
                                        <router-link style="padding-left: 20px" :to="{name: 'Pages', params: {id: item.id}}">Pages</router-link>
                                        <button style="padding-left: 20px" @click="subnav.editSubNav(item)">Edit</button>
                                        <button style="padding-left: 20px" @click="subnav.deleteSubNavs(item)">Delete</button>
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

import {subnavigationsStore}from '@/Admin/Stores/subnavigationsStore';
import {storeToRefs} from 'pinia';

const route = useRoute();


const subnav = subnavigationsStore()
const{form} = storeToRefs(subnav)  

onMounted(async () => {
    const id = ref(route.params.id);
    await subnav.fetchSubNavData(id.value);
});     

subnav.getter();
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