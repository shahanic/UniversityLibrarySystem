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
    <div class="w-64 bg-green-700 dark:bg-gray-900 h-screen pt-16 overflow-hidden sidebar">
        <div class="flex -mt-1 px-2 gap-1">
            <div class="flex self-center w-20 h-14">
                <img class="rounded-full" src="https://www.mmsu.edu.ph/mmsu_logo/mmsu_logo.png"/>
                <!-- <img class="rounded-full" src="imgs/mmsu.png"/> -->

            </div>
            <div class="flex self-center">
                <p class="font-semibold text-white text-sm">University Library System</p>
            </div>
        </div>

        <div class="flex flex-col mt-2 border-green-300 border-t dark:border-gray-700">
            <router-link to="/super-user" :class="`nav-links hover:bg-green-500 dark:hover:bg-gray-800 ${$route.name.includes('Dashboard') ? 'sidebar-selected' : ''}`">
                Home
            </router-link>
            <router-link to="/navigation" :class="`nav-links hover:bg-green-500 dark:hover:bg-gray-800 ${$route.name.includes('Navigation') ? 'sidebar-selected' : ''}`">
                Navigation
            </router-link>
            <router-link to="/generic-pages" :class="`nav-links hover:bg-green-500 dark:hover:bg-gray-800 ${$route.name.includes('GenericPage') ? 'sidebar-selected' : ''}`">
                Generic Pages
            </router-link>
            <router-link to="/article-pages" :class="`nav-links hover:bg-green-500 dark:hover:bg-gray-800 ${$route.name.includes('ArticlePages') ? 'sidebar-selected' : ''}`">
                Articles
            </router-link>
            <router-link to="/faqs" :class="`nav-links hover:bg-green-500 dark:hover:bg-gray-800 ${$route.name.includes('Faqs') ? 'sidebar-selected' : ''}`">
                FAQs
            </router-link>
            <router-link to="/quick-links" :class="`nav-links hover:bg-green-500 dark:hover:bg-gray-800 ${$route.name.includes('QuickLinks') ? 'sidebar-selected' : ''}`">
                Quick Links
            </router-link>
            <router-link to="/images" :class="`nav-links hover:bg-green-500 dark:hover:bg-gray-800 ${$route.name.includes('Images') ? 'sidebar-selected' : ''}`">
                Images
            </router-link>
            <router-link to="/accounts" :class="`nav-links hover:bg-green-500 dark:hover:bg-gray-800 ${$route.name.includes('Accounts') ? 'sidebar-selected' : ''}`">
                Accounts
            </router-link>

            <div class="flex items-center justify-center w-full border-t border-green-300 dark:border-gray-700 pt-4">
            </div>
        </div>

        <div class="absolute bottom-3 right-3">
            <span class="text-sm text-white font-semibold">version 2.2.5</span>  
        </div>
    </div>
</template>


<style scoped>
.shadow-lg {
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 10px 15px rgba(0, 0, 0, 0.1);
}

.nav-links {
    padding: 0.75rem 1rem;
    margin: 0.25rem 0;
    font-size: 0.875rem;
    color: white;
    text-decoration: none;
    transition: all 0.6s;
    border-radius: 0.375rem;
}

.nav-links:hover {
    transform: translateX(5px);
}

.dark .nav-links {
    color: #d1d5db;
}

.dark .nav-links:hover {
    color: #f3f4f6;
}
.sidebar {
    border-radius: 10px;
}

.sidebar-selected {
    background: linear-gradient(135deg, #5fcc64 0%, #1B5E20 100%);
    position: relative;
    color: white; /* Ensure text color is white */
}

.sidebar-selected::before {
    content: '';
    position: absolute;
    right: 0px; /* Adjust this value to move the triangle inside the box */
    top: 50%;
    transform: translateY(-50%);
    width: 0;
    height: 0;
    border-right: 17px solid white; /* White color for the triangle */
    border-top: 17px solid transparent;
    border-bottom: 17px solid transparent;
}

/* For dark mode */
.dark .sidebar-selected::before {
    border-right-color: white; /* Ensure triangle is white in dark mode */
}

</style>