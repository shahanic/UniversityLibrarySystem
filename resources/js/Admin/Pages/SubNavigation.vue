<script setup>
import {subnavigationStore}from '@/Admin/Stores/subnavigationStores';
import {storeToRefs} from 'pinia';


const subnav = subnavigationStore()
const{form} = storeToRefs(subnav)  

subnav.getter();


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
            <label for="">Navigation id: </label>
            <input type="text" v-model="form.navigation_id">
            <label for="">Submenu: </label>
            <input type="text" v-model="form.submenu">
        </div>
    
        <div>
            <button @click="nav.save()">Save</button>
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
                <tr v-for="(subnavx, i) in subnav.submenus":key="i">
                    <td class="border border-gray-300 p-2">{{++i}}</td>
                    <td class="border border-gray-300 p-2">{{subnavx.navigation_id}}</td>
                    <td class="border border-gray-300 p-2">{{subnavx.submenu}}</td>
                    
              
                    <td class="border border-gray-300 p-2 text-center">
                        <button class="bg-yellow-500 text-black px-2 py-1 rounded mr-3"  @click="subnav.editSubNav(navx)">Edit</button>
                        <button class="bg-yellow-500 text-black px-2 py-1 rounded mr-3"  @click="subnav.deleteSubNavs(navx)">Delete</button>
                    </td>
                    
                </tr>
            </tbody>
        </table>
    </div>
        </template>
    </admin-layout>
</template>