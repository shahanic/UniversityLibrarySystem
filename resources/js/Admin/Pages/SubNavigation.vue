<template>
    <admin-layout>
        <template v-slot:main> 
            <div class="container mx-auto p-4">
                <h1 class="text-2xl font-bold mb-4" >Sub Navigation List</h1>
                    <div v-if="subnav.sub_menus.length">
                        <table class="min-w-full border-collapse border border-gray-300">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="border border-gray-300 p-2">Submenus</th>
                                    <th class="border border-gray-300 p-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in subnav.sub_menus" :key="item.id">
                                    <td class="border border-gray-300 p-2">{{ item.submenu }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
            </div>
        </template>
    </admin-layout>
    <!-- <div>
        <table class="min-w-full border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="border border-gray-300 p-2">#</th>
                    <th class="border border-gray-300 p-2">Navigation ID</th>
                    <th class="border border-gray-300 p-2">Sub Menu</th>
                    <th class="border border-gray-300 p-2">Actions</th>
                </tr>   
            </thead>  
            <tbody>
                <tr v-for="(subnavx, i) in subnav.sub_menus":key="i">
                    
                    <td class="border border-gray-300 p-2">{{++i}}</td>
                    <td class="border border-gray-300 p-2">{{subnavx.navigation_id}}</td>
                    <td class="border border-gray-300 p-2">{{subnavx.submenu}}</td>
                    <td class="border border-gray-300 p-2 text-center">
                        <button class="bg-yellow-500 text-black px-2 py-1 rounded mr-3"  @click="subnav.editSubNav(navx)">Edit</button>
                        <button class="bg-yellow-500 text-black px-2 py-1 rounded mr-3"  @click="subnav.deleteSubNavs(navx)">Delete</button>
                    </td>
                    <div>
                </div>
                </tr>
            </tbody>
        </table>
    </div> -->


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

// const fetchData = async (id) => {
//     await subnavigationsStore.fetchSubNavData(id);
// }
</script>


<!-- <template>
    <admin-layout>
        <template v-slot:main>
            <div>
                <H1>Main Navigation</H1>
                <p></p>
                <td></td>
            </div>
            <div>
            <label for="">Navigation id: </label>
            <input type="text" v-model="form.navigation_id">
            <label for="">Submenu: </label>
            <input type="text" v-model="form.submenu">
        </div>
    
        <div>
            <button @click="subnav.save()">Save</button>
        </div>

    <div>
        <table class="min-w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 p-2">#</th>
                    <th class="border border-gray-300 p-2">Navigation ID</th>
                    <th class="border border-gray-300 p-2">Sub Menu</th>
                    <th class="border border-gray-300 p-2">Actions</th>
                </tr>
                
            </thead>  
            <tbody>
                <tr v-for="(subnavx, i) in subnav.sub_menus":key="i">
                    
                    <td class="border border-gray-300 p-2">{{++i}}</td>
                    <td class="border border-gray-300 p-2">{{subnavx.navigation_id}}</td>
                    <td class="border border-gray-300 p-2">{{subnavx.submenu}}</td>
                    
              
                    <td class="border border-gray-300 p-2 text-center">
                        <button class="bg-yellow-500 text-black px-2 py-1 rounded mr-3"  @click="fetchSubNavData(navx.id)">View</button>
                        <button class="bg-yellow-500 text-black px-2 py-1 rounded mr-3"  @click="subnav.editSubNav(navx)">Edit</button>
                        <button class="bg-yellow-500 text-black px-2 py-1 rounded mr-3"  @click="subnav.deleteSubNavs(navx)">Delete</button>
                    </td>
                    <div>
                    <div v-if="subNavData.length">
                        <table class="min-w-full border-collapse border border-gray-300">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="border border-gray-300 p-2">Submenus</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in subNavData" :key="item.id">
                                    <td class="border border-gray-300 p-2">{{ item.submenu }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                </tr>
            </tbody>
        </table>
    </div>
        </template>
    </admin-layout>
</template> -->