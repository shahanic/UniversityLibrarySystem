<script setup>
import {navigationStore}from '@/Admin/Stores/navigationStores';
import {storeToRefs} from 'pinia';


const nav = navigationStore()
const{form} = storeToRefs(nav)  

nav.getter();

import { ref } from 'vue';
import axios from 'axios';

const subNavData = ref([]);

const fetchSubNavData = async (id) => {
    try {
        const response = await axios.get('/get-sub-nav', {params: {id} });
        subNavData.value = response.data;
    } catch (error) {
        console.error('Error fetching sub navigation data:', error);
    }
};

</script>
<template>
    <admin-layout>
        <template v-slot:main>
            <div>
                <H1>Main Navigation</H1>
                <p></p>
                <td></td>
            </div>
            <div>
            <label for="">Menu: </label>
            <input type="text" v-model="form.menu">
        </div>
    
        <div>
            <button @click="nav.save()">Save</button>
        </div>

  

    
    <div>
        <table class="min-w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 p-2">#</th>
                    <th class="border border-gray-300 p-2">Menu</th>
                    <th class="border border-gray-300 p-2">Actions</th>
                </tr>
                
            </thead>  
            <tbody>
                <tr v-for="(navx, i) in nav.navigations":key="i">
                    <td class="border border-gray-300 p-2">{{++i}}</td>
                    <td class="border border-gray-300 p-2">{{navx.menu}}</td>
              
                    <td class="border border-gray-300 p-2 text-center">
                        <button class="bg-yellow-500 text-black px-2 py-1 rounded mr-3"  @click="fetchSubNavData(navx.id)">View</button>
                        <button class="bg-yellow-500 text-black px-2 py-1 rounded mr-3"  @click="nav.editNav(navx)">Edit</button>
                        <button class="bg-yellow-500 text-black px-2 py-1 rounded mr-3"  @click="nav.deleteNavs(navx)">Delete</button>
                    </td>
                    
                </tr>
                <div>
                    <div v-if="subNavData.length">
                        <h2>Sub Navigation Data</h2>
                        <ul>
                            <li v-for="item in subNavData" :key="item.id">{{ item.submenu }}</li>
                        </ul>
                    </div>
                </div>
            </tbody>
        </table>
    </div>
        </template>
    </admin-layout>
</template>