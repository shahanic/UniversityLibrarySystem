<template lang="">
    <div class="h-screen flex flex-col items-stretch">
         <header class="flex-shrink-0 z-40">
             <mobile-nav @signOut="logout"></mobile-nav>
         </header>
         
         <div class="hidden md:flex shadow backdrop-blur-md bg-white/60 w-full  dark:bg-gray-700/60 fixed z-40">
             <div class="w-64 bg-green-700 dark:bg-gray-800/50 flex items-center">
                 <h4 class="ml-4 text-white font-semibold ">MMSU</h4>
             </div>
             <div class=" flex items-center w-1/6">
                <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-white focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                   <span class="sr-only">Open sidebar</span>
                   <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                   <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                   </svg>
                </button>
                 <h4 class="ml-4 uppercase dark:text-gray-50 truncate">{{ $route.name }}</h4>
             </div>

             <div class="flex-grow flex items-center gap-2 md:px-20">

                 <!-- <div class="flex-grow justify-end">
                     <member-search></member-search>
                 </div> -->
             </div>

             <div class="w-1/8">

                 <div class="flex flex-row-reverse">
                     <dropdown>
                         <template #trigger>
                             <div class="flex item-stretch text-sm cursor-pointer py-2.5 px-4 hover:bg-white dark:hover:bg-gray-500 dark:text-white gap-2" href="#">
                                 <div><img class="h-8 w-8 rounded-full border-2 border-gray-600 " src="/images/User-Icon.png"></div>
                                 <div class="self-center truncate">{{ $attrs.user.name }}</div>
                                 <div class="self-center">
                                     <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                         <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                     </svg>
                                 </div>
                             </div>
                         </template>

                         <template #content>
                             <div>
                                 <router-link to="/v2/password" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-500 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">Update Password</router-link>
                             </div>
                             <form @submit.prevent="logout">
                                 <dropdown-link as="button">Logout</dropdown-link>
                             </form>
                         </template>
                     </dropdown>

                 </div>
             </div>
         </div>

         <main class="flex-grow flex-shrink-0 mt-14 lg:mt-0 z-30 dark:bg-gray-800 bg-white">
             <!-- <div class="fixed w-full h-screen top-0 blur-sm"> 
                 <div class="flex-col">
                     <div class="flex justify-center mt-32 md:ml-72 ml-24">
                         <div class="w-32 h-32 rounded-full bg-yellow-400 dark:opacity-10 opacity-20"></div>
                     </div>
                     <div class="flex justify-center gap-52 ml-56">
                         <div class="w-44 h-44 rounded-full bg-green-600 dark:opacity-10 opacity-20"></div>
                         <div class="w-48 h-48 rounded-xl bg-gradient-to-r from-indigo-400 to-red-400 rotate-45 dark:opacity-10 opacity-20 mt-16"></div>
                     </div>
                     <div class="flex justify-center mt-5 md:ml-32 ">
                         <div class="w-28 h-28 rounded-full bg-blue-700 dark:opacity-10 -mt-10 opacity-20"></div>
                     </div>
                     <div class="flex justify-center mt-10 md:ml-72 ml-16">
                         <div class="w-16 h-16 rounded-full bg-red-500 dark:opacity-10 opacity-20"></div>
                     </div>
                 </div>
             </div> -->
             <div>
                 <div class="flex">
                     <div class="flex-none hidden w-64 md:block z-40">
                         <div class="w-64 fixed">
                             <side-bar :degree="`nagan`"></side-bar>
                         </div>
                     </div>
                     <div class="block flex-grow overflow-x-auto z-10 min-h-screen py-16 px-5">
                         <slot name="main"></slot>
                     </div>
                 </div>
             </div>
         </main>
     </div>

     <slot name="modal">
     </slot>

 </template>
 <script>
    import Dropdown from "@/Components/Extras/Dropdown.vue";
     import DropdownLink from "@/Components/Extras/DropdownLink.vue";
     import SideBar from "./SideBar.vue";
     import MobileNav from "./MobileNav.vue";
     import MemberSearch from "@/Components/InventorySearch.vue";
     
 export default {
    name: "MainLayout",
    components: {MobileNav, DropdownLink, Dropdown, MemberSearch, SideBar},
    methods: {
       logout() {
             window.axios.post(`/logout`).then(() => {
                window.location.href = '/super-user';
             }).catch(e => {
                setTimeout(() => {
                   window.location.href = '/super-user';
                }, 500)
             });
       }
    }

 }
 </script>
 <style lang="">

 </style>
