<script setup>
import {accountsStore}from '@/Admin/Stores/accountsStores';
import {storeToRefs} from 'pinia';



const user = accountsStore()
const{form} = storeToRefs(user)  

user.getter();
</script>
<template>
    <admin-layout>
        <template v-slot:main>
            <div>
                <H1>Accounts</H1> 
                <p> </p>
                <td></td>
            </div>
            <div>

        <div>
            <label for="">Name: </label>
            <input type="text" v-model="form.name">
        </div>
        <div>
            <label for="">Email: </label>
            <input type="text" v-model="form.email"> 
        </div>
        <div>
            <label for="">Username: </label>
            <input type="text" v-model="form.username"> 
        </div>
        <div>
            <label for="">Role: </label>
            <input type="text" v-model="form.role"> 
        </div>
        <div>
            <label for="">Password: </label>
            <input type="text" v-model="form.password"> 
        </div>
        <div>
            <button @click="user.save()" class="bg-green-700 text-black px-2 py-1 rounded mr-3" >Save</button>
            
        </div>
        <br>
        <div>
        <button @click="user.add()" class="bg-blue-700 text-black px-2 py-1 rounded mr-3">Add</button>
        </div>
    </div>
    <div>
        <table class="min-w-full border-collapse border border-gray-300">
          <thead>
            <tr class="bg-gray-900">
              <th class="border border-gray-300 text-white p-2">#</th>
              <th class="border border-gray-300 text-white p-2">Name</th>
              <th class="border border-gray-300 text-white p-2">Email</th>
              <th class="border border-gray-300 text-white p-2">Username</th>
              <th class="border border-gray-300 text-white p-2">Role</th>
              <th class="border border-gray-300 text-white p-2">Password</th>
              <th class="border border-gray-300 text-white p-2">Action</th>
              </tr>
            </thead>
            <tbody>
                <tr v-for="(userx, index) in user.users" :key="index" class="bg-gray-500">
              <td class="border border-gray-300 text-white p-2">{{ index + 1 }}</td>
              <td class="border border-gray-300 text-white p-2">{{ userx.name }}</td>
              <td class="border border-gray-300 text-white p-2">{{ userx.email }}</td>
              <td class="border border-gray-300 text-white p-2">{{ userx.username }}</td>
              <td class="border border-gray-300 text-white p-2">{{ userx.role }}</td>
              <td class="border border-gray-300 text-white p-2">{{ userx.password }}</td>
              <td class="border border-gray-300 text-white p-2 text-center">
                <button @click="user.editUser(userx)" class="bg-yellow-500 text-black px-2 py-1 rounded mr-3">Edit</button>
                <button @click="user.deleteUser(userx)" class="bg-red-500 text-black px-2 py-1 rounded">Delete</button>
              </td>
            </tr>
            </tbody>
        </table>
    </div>



        </template>
    </admin-layout>
</template>