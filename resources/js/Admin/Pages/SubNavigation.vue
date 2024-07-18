<script setup>
import {navigationStore}from '@/Admin/Stores/subnavigationStores';
import {storeToRefs} from 'pinia';


const subnav = navigationStore()
const{form} = storeToRefs(subnav)  

nav.getter();
</script>
<template>
    <admin-layout>
        <template v-slot:main>
            <div>
                <H1>Sub Navigation</H1>
                <p></p>
                <td></td>
            </div>
            <div>
            <label for="">Menu: </label>
            <input type="text" v-model="form.submenu">
        </div>
    
        <div>
            <button @click="subnav.save()">Save</button>
        </div>

  

    
    <div>
        <table>
            <thead>
                <th class="bg-gray-500">#</th>
                <th class="border border-gray-300 text-white p-2">Sub Menu</th>
                <th class="border border-gray-300 text-white p-2">Actions</th>
            </thead>  
            <tbody>
                <tr v-for="(subnavx, i) in subnav.sub_menus":key="i">
                    <td class="border border-gray-300 text-white p-2">{{++i}}</td>
                    <td class="border border-gray-300 text-white p-2">{{subnavx.submenu}}</td>
              
                    <td>
                        <button class="bg-yellow-500 text-black px-2 py-1 rounded mr-3"  @click="nav.editNav(navx)">edit</button>
                        <button class="bg-red-500 text-black px-2 py-1 rounded mr-3"  @click="nav.deleteNavs(navx)">delete</button>
                        <button class="bg-green-500 text-black px-2 py-1 rounded mr-3"  @click="nav.editNav(navx)">show</button>
                    </td>
                   

                </tr>
            </tbody>
        </table>
    </div>
        </template>
    </admin-layout>
</template>