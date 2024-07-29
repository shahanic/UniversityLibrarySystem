
<template>
    <admin-layout>
        <template v-slot:main>     
        <div class="container mx-auto p-4">
          <button @click="addSubNav" class="bg-green-700 text-white px-2 py-1 rounded mr-3">Add New Sub Menu</button>
    
        <AddSubNavigationModal :isVisible="showModal" @close="showModal = false "@save="saveSubNav">
        <div>
        <!--  -->
        <div>
               <h1 style="text-align: center;">Add Sub Menu</h1>
              </div>
                      <!--  -->

                <div>
                <label for="menu">Sub Menu:</label><br>
                <input type="text" v-model="form.submenu" class="w-full rounded-lg border-gray-300">
                </div>
                <div>
         
                   <!-- <div class="flex justify-start  ">
                  <button @click="saveUser" class="bg-green-700 text-white px-2 py-1 rounded mr-3">Save</button>
                    </div> -->
              </div>
    </div>
        </AddSubNavigationModal>
                <h2> Sub Navigation List</h2>
                    <div v-if="subnav.sub_menus.length">
                        <table >
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Navigation</th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in subnav.sub_menus" :key="item.id">
                                    <td style="width: 30%">{{ item.submenu }}</td>
                                    <td style="width: 48%">{{ item.menu }}</td>
                                    <td>
                                        <router-link style="padding-left: 20px" :to="{name: 'GenericPage', params: {id: item.id}}" custom v-slot="{ navigate }">
                                          <button @click="navigate" class="bg-green-700 text-black px-2 py-1 rounded mr-3">Pages</button>
                                        </router-link>
                                        <button @click="editSubNav(item)" class="bg-yellow-400 text-black px-2 py-1 rounded mr-3">Edit</button>
                                        <button @click="deleteSubNav(item)" class="bg-red-400 text-black px-2 py-1 rounded">Delete</button>
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

import {subnavigationsStore}from '@/Admin/Stores/subnavigationStore';
import {storeToRefs} from 'pinia';

import AddSubNavigationModal from '@/Admin/Modals/AddSubNavigationModal.vue';

const route = useRoute();
const subnav = subnavigationsStore()
const{form} = storeToRefs(subnav)  

onMounted(async () => {
    const id = ref(route.params.id);
    await subnav.fetchSubNavData(id.value);
  });  


const showModal = ref(false);
const currentSubNav = ref(null);  // To store the user being edited

const saveSubNav = () => {
  if (currentSubNav.value) {
    subnav.editSubNav(form.value);
    subnav.save();
  } else {
    subnav.save();
  }
  showModal.value = false;  // Close the modal after saving
};

const addSubNav = () => {
  currentSubNav.value = null;  // Clear current nav for adding a new nav
  showModal.value = true;
};

const editSubNav = (subnavx) => {
  currentSubNav.value = subnavx;  // Set the nav to be edited
  Object.assign(form.value, subnavx);  // Populate form with nav data
  showModal.value = true;
};

const deleteSubNav = (subnavx) => {
  subnav.deleteSubNav(subnavx);
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