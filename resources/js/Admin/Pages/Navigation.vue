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
            <button @click="nav.save()">Save</button>
        </div>

  

    
    <div>
        <table>
            <thead>
                <th>#</th>
                <th>Menu</th>
            </thead>  
            <tbody>
                <tr v-for="(navx, i) in nav.navigations":key="i">
                    <td class="border border-gray-300 text-white p-2">{{++i}}</td>
                    <td class="border border-gray-300 text-white p-2">{{navx.menu}}</td>
              
                    <td>
                        <button class="bg-yellow-500 text-black px-2 py-1 rounded mr-3"  @click="nav.editNav(navx)">Show</button>
                    </td>
                   

                </tr>
            </tbody>
        </table>
    </div>
        </template>
    </admin-layout>
</template>