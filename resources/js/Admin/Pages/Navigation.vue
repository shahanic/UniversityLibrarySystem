<script setup>
import { ref } from 'vue';
import {navigationStore}from '@/Admin/Stores/navigationStores';
import {storeToRefs} from 'pinia';
import CKEditor from '@ckeditor/ckeditor5-vue';
import AddNavigationModal from '@/Admin/Modals/AddNavigationModal.vue';
const nav = navigationStore()
const{form} = storeToRefs(nav)  

nav.getter();
const showModal = ref(false);
const currentNav = ref(null);  // To store the user being edited

const saveNav = () => {
  if (currentNav.value) {
    nav.editNav(form.value);
    nav.save();
  } else {
    nav.save();
  }
  showModal.value = false;  // Close the modal after saving
};

const addNav = () => {
  currentNav.value = null;  // Clear current nav for adding a new nav
  showModal.value = true;
};

const editNav = (navx) => {
  currentNav.value = navx;  // Set the nav to be edited
  Object.assign(form.value, navx);  // Populate form with nav data
  showModal.value = true;
};

const deleteNav = (navx) => {
  nav.deleteNav(navx);
};



</script>
<template>
    <admin-layout>
        <template v-slot:main>
           <!-- <h1 style="padding:20px"></h1> -->
           <div class="container mx-auto p-4">
            <button @click="addNav" class="bg-green-700 text-white px-2 py-1 rounded mr-3">Add New Menu</button>
            <h2>Main Navigation List</h2>
              <AddNavigationModal :isVisible="showModal" @close="showModal = false "@save="saveNav">
              <div>
                    <!--  -->
               <div>
               <h1 style="text-align: center;">Add Menu</h1>
              </div>
                      <!--  -->

                <div>
                <label for="menu">Menu:</label><br>
                <input type="text" v-model="form.menu" class="w-full rounded-lg border-gray-300">
                </div>
                <div>
         
                   <!-- <div class="flex justify-start  ">
                  <button @click="saveUser" class="bg-green-700 text-white px-2 py-1 rounded mr-3">Save</button>
                    </div> -->
              </div>
            </div>
        </AddNavigationModal>
        <table>
          <thead>
            <tr>
              <th>Title</th>
                <th>Actions</th>
            </tr>       
          </thead> 
          <tbody>
            <tr v-for="navx in nav.navigations":key="i">
                <td style="width: 78%;">{{navx.menu}}</td>
                <router-link :to="{ name: 'SubNavigation', params: { id: navx.id } }" custom v-slot="{ navigate }">
                  <button @click="navigate" class="bg-green-700 text-black px-2 py-1 rounded mr-3">View</button>
                </router-link>
                <button @click="editNav(navx)" class="bg-yellow-400 text-black px-2 py-1 rounded mr-3">Edit</button>
                <button @click="deleteNav(navx)" class="bg-red-400 text-black px-2 py-1 rounded">Delete</button>
            </tr>
          </tbody>
        </table>
        <br>


      </div>
         
        </template>
    </admin-layout>
</template>

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