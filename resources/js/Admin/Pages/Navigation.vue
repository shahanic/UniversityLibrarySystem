Charry Ann Omayama Cachero
<script setup>
import {navigationStore}from '@/Admin/Stores/navigationStores';
import {storeToRefs} from 'pinia';


const nav = navigationStore()
const{form} = storeToRefs(nav)  

nav.getter();
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
            <button class="bg-yellow-500 text-black px-2 py-1 rounded mr-3" @click="nav.save()">Save</button>
        </div>
        <div> 
        </div>

  
    <div>
        <table>
            <thead>
                <tr class = "bg-gray-500">
                <th class="border border-gray-300 text-white p-2">#</th>
                <th class="border border-gray-300 text-white p-2">Menu</th>
                <th class="border border-gray-300 text-white p-7=2">Actions</th>
                </tr>
            </thead>  
            <tbody>
                <tr v-for="(navx, i) in nav.navigations":key="i" class="bg-gray-700">
                    <td class="border border-gray-300 text-white p-2">{{++i}}</td>
                    <td class="border border-gray-300 text-white p-2">{{navx.menu}}</td>
                    <td class="border border-gray-300 text-white p-2 text-center">
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