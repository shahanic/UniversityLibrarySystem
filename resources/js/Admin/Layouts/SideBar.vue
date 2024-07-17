    <script setup>
    import { ref, onBeforeMount } from 'vue';
    import { useRoute } from 'vue-router';
    const route = useRoute();


    const dark = ref(false);
    const collapse_open = ref(0);


    function expandMe(val) {
        collapse_open === val? (collapse_open.value = 0): (collapse_open.value = val)
    }

    function checker(){
        if(route.name.includes('members')){
            collapse_open.value = 1;
        }
        if(route.path.includes('manage')){
            collapse_open.value = 2;
        }
    }

    function initTheme(){
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
            localStorage.theme = 'dark'
            dark.value = true
        } else {
            document.documentElement.classList.remove('dark')
            localStorage.removeItem('theme')
            localStorage.theme = 'light'
            dark.value = false
        }
    }

    function testing(){
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.remove('dark')
            localStorage.removeItem('theme')
            localStorage.theme = 'light'
            dark.value = false
        } else {
            document.documentElement.classList.add('dark')
            localStorage.theme = 'dark'
            dark.value = true
        }
    }

    onBeforeMount(() => {
        initTheme();
    });


    </script>

    <template>
        <div class="w-64 bg-blue-600 dark:bg-gray-900 h-screen pt-16 overflow-x-auto">
            <div class="flex -mt-1 px-2 gap-1 ">
                <div class="flex self-center w-20 h-14 ">
                    <!-- <img class="rounded-full"  src="/images/logo.jpg"/> -->
                    <img class="rounded-full"  src="https://www.mmsu.edu.ph/mmsu_logo/mmsu_logo.png"/>
                </div>
                <div class="flex self-center">
                    <p class="font-semibold text-white text-sm">University Library System</p>
                    <!-- <p class="font-semibold text-white text-sm">Inventory Management System</p> -->
                </div>
            </div>


            <div class="flex flex-col mt-2 border-green-300 border-t dark:border-gray-700">
                <router-link to="/super-user" :class="`nav-links hover:bg-blue-500 dark:hover:bg-gray-700 ${$route.name.includes('Dashboard')? 'bg-blue-700 dark:bg-gray-600' : ''}`">Home</router-link>

                <router-link to="/generic-pages" :class="`nav-links hover:bg-blue-500 dark:hover:bg-gray-700 ${$route.path.includes('GenericPages')? 'bg-blue-700 dark:bg-gray-600' : ''}`">Generic Page</router-link>

                <router-link to="/article-pages" :class="`nav-links hover:bg-blue-500 dark:hover:bg-gray-700 ${$route.path.includes('ArticlePages')? 'bg-blue-700 dark:bg-gray-600' : ''}`">Articles</router-link>

                <router-link to="/faqs" :class="`nav-links hover:bg-blue-500 dark:hover:bg-gray-700 ${$route.path.includes('Faqs')? 'bg-blue-700 dark:bg-gray-600' : ''}`">FAQs</router-link>


                <router-link to="/quick-links" :class="`nav-links hover:bg-blue-500 dark:hover:bg-gray-700 ${$route.path.includes('QuickLinks')? 'bg-blue-700 dark:bg-gray-600' : ''}`">Quick Links</router-link>

                <router-link to="/images" :class="`nav-links hover:bg-blue-500 dark:hover:bg-gray-700 ${$route.path.includes('ArticlePages')? 'bg-blue-700 dark:bg-gray-600' : ''}`">Images</router-link>

                <!-- <div :class="`text-white font-semibold hover:bg-blue-500 dark:hover:bg-gray-700 ${$route.path.includes('members')? 'bg-blue-700 dark:bg-gray-700' : ''} ${collapse_open === 1? 'bg-blue-700 dark:bg-gray-700' : ''}`" >
                    <div class=" px-5 py-3 cursor-pointer block" @click="expandMe(1)">
                        <span class="text-end text-white">{{collapse_open === 1? '▾' : '▸'}}</span> Inventory
                    </div>

                    <div class="flex flex-col pl-5" :class="{
                            'overflow-hidden transition-all duration-300': true,
                            'max-h-0': collapse_open !== 1,
                            'max-height-px mt-4': collapse_open === 1
                        }">

                        <router-link to="/inventory/fertilizers" :class="`dark:hover:bg-gray-600 nav-links ${$route.path.includes('fertilizers')? 'bg-blue-800 dark:bg-gray-600' : ''}`">↳ Fertilizers</router-link>
                        <router-link to="/inventory/chemicals" :class="`dark:hover:bg-gray-600 nav-links ${$route.path.includes('chemicals')? 'bg-blue-800 dark:bg-gray-600' : ''}`">↳ Chemicals</router-link>
                        <router-link to="/inventory/feeds" :class="`dark:hover:bg-gray-600 nav-links ${$route.path.includes('feeds')? 'bg-blue-800 dark:bg-gray-600' : ''}`">↳ Feeds</router-link>
                        <router-link to="/inventory/palayandcorn" :class="`dark:hover:bg-gray-600 nav-links ${$route.path.includes('palayandcorn')? 'bg-blue-800 dark:bg-gray-600' : ''}`">↳ Palay and Corn</router-link>
                        <router-link to="/inventory/sacksandothers" :class="`dark:hover:bg-gray-600 nav-links ${$route.path.includes('others')? 'bg-blue-800 dark:bg-gray-600' : ''}`">↳ Sacks and Others</router-link> 
                    </div>
                </div> -->

                <!-- <div :class="`text-white font-semibold hover:bg-blue-500 dark:hover:bg-gray-700 ${$route.path.includes('students')? 'bg-blue-700 dark:bg-gray-700' : ''} ${collapse_open === 2? 'bg-blue-700 dark:bg-gray-700' : ''}`" >
                    <div class=" px-5 py-3 cursor-pointer block" @click="expandMe(2)">
                        <span class="text-end text-white">{{collapse_open === 2? '▾' : '▸'}}</span> Management
                    </div>

                    <div class="flex flex-col pl-5" :class="{
                            'overflow-hidden transition-all duration-300': true,
                            'max-h-0': collapse_open !== 2,
                            'max-height-px mt-4': collapse_open === 2,
                        }">
                        <router-link to="/manage/products" :class="`nav-links hover:bg-blue-500 dark:hover:bg-gray-600 ${$route.name.includes('Products') || $route.name.includes('Product')? 'bg-blue-700 dark:bg-gray-600' : ''}`">↳ Products</router-link>
                        <router-link to="/manage/categories" :class="`dark:hover:bg-gray-600 nav-links ${$route.name.includes('Categories')? 'bg-blue-700 dark:bg-gray-600' : ''}`">↳ Categories</router-link>
                        <router-link to="/manage/units" :class="`dark:hover:bg-gray-600 nav-links ${$route.name.includes('Units')? 'bg-blue-700 dark:bg-gray-600' : ''}`">↳ Units</router-link>
                        <router-link to="/manage/suppliers" :class="`nav-links dark:hover:bg-gray-600 ${$route.name.includes('Suppliers')? 'bg-blue-700 dark:bg-gray-600' : ''}`">↳ Suppliers</router-link>
                    </div>
                </div> -->

                <router-link to="/accounts" :class="`nav-links hover:bg-blue-500 dark:hover:bg-gray-700 ${$route.path.includes('accounts')? 'bg-blue-700 dark:bg-gray-600' : ''}`">Accounts</router-link>


                    <div class="flex items-center justify-center w-full border-t border-green-300 dark:border-gray-700 pt-4">
                        <label for="toggleB" class="flex items-center cursor-pointer"> 
                            <div class="relative">
                                <input type="checkbox" id="toggleB" class="sr-only" v-model="dark" @change="testing()">
                                <div class="block bg-gray-600 dark:bg-gray-100 w-14 h-8 rounded-full"></div>
                                <div class="dot absolute left-1 top-1  dark:bg-gray-600 bg-white w-6 h-6 rounded-full transition"></div>
                            </div>
                            <div class="ml-3 text-white font-medium font-bold dark:text-gray-50">
                                {{ !dark? '🌑 DARK' : '🔆 LIGHT'}} MODE 
                            </div>
                        </label>
                    </div>
            </div>



            <div class=" absolute bottom-3 right-3">
                <span class="text-sm text-white font-semibold">version 2.2.5</span>  
            </div>
        </div>
    </template>


    <style scoped>
        /* Toggle B */
        input:checked ~ .dot {
        transform: translateX(100%);
        background-color: rgb(65, 65, 65);
        }
    </style>
