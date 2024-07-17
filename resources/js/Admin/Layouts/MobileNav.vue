<template>
    <div>

        <nav class="flex fixed w-full items-center justify-between px-6 h-16 bg-white dark:bg-gray-700 shadow gray-text z-10 md:hidden">
            <button class="mr-1" aria-label="Open Menu" @click="drawer">
                <svg
                        fill="none"
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                        class="w-8 h-8 dark:text-white"
                >
                    <path d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
            <a class="block mx-auto" href="/">
                <span><img class="h-12" src="/img/seal/MMSU.png"></span>
            </a>
            <div class="mr-8 h-auto">

            </div>

            <transition
                    enter-class="opacity-0"
                    enter-active-class="ease-out transition-medium"
                    enter-to-class="opacity-100"
                    leave-class="opacity-100"
                    leave-active-class="ease-out transition-medium"
                    leave-to-class="opacity-0"
            >
                <div
                        @keydown.esc="isOpen = false"
                        v-show="isOpen"
                        class="z-10 fixed inset-0 transition-opacity"
                >
                    <div
                            @click="isOpen = false"
                            class="absolute inset-0 bg-black/50"
                            tabindex="0"
                    ></div>
                </div>
            </transition>

            <aside
                    class="transform top-0 left-0 w-64 backdrop-blur bg-white/80 dark:bg-gray-700/80  fixed h-full overflow-auto ease-in-out transition-all duration-300 z-30"
                    :class="isOpen ? 'translate-x-0' : '-translate-x-full'"
            >
                <div
                        @click="isOpen = false"
                        class="flex w-full items-center border-b"
                >
                </div>

                <div class="grid grid-cols-1 text-gray-500 dark:text-white">
                    <div class=" py-3.5">
                        

                        <p class="text-xs block p-2 text-gray-400 dark:text-gray-500 font-semibold">Menu</p>
                        <router-link to="/super-user" :class="`nav-links hover:bg-blue-500 dark:hover:bg-gray-700 ${$route.name.includes('Dashboard')? 'bg-blue-700 dark:bg-gray-600' : ''}`">Home</router-link>

                        <router-link to="/generic-pages" :class="`nav-links hover:bg-blue-500 dark:hover:bg-gray-700 ${$route.path.includes('GenericPages')? 'bg-blue-700 dark:bg-gray-600' : ''}`">Generic Page</router-link>

                        <router-link to="/article-pages" :class="`nav-links hover:bg-blue-500 dark:hover:bg-gray-700 ${$route.path.includes('ArticlePages')? 'bg-blue-700 dark:bg-gray-600' : ''}`">Articles</router-link>

                        <router-link to="/faqs" :class="`nav-links hover:bg-blue-500 dark:hover:bg-gray-700 ${$route.path.includes('Faqs')? 'bg-blue-700 dark:bg-gray-600' : ''}`">FAQs</router-link>


                        <router-link to="/quick-links" :class="`nav-links hover:bg-blue-500 dark:hover:bg-gray-700 ${$route.path.includes('QuickLinks')? 'bg-blue-700 dark:bg-gray-600' : ''}`">Quick Links</router-link>

                        <router-link to="/images" :class="`nav-links hover:bg-blue-500 dark:hover:bg-gray-700 ${$route.path.includes('ArticlePages')? 'bg-blue-700 dark:bg-gray-600' : ''}`">Images</router-link>
                    </div>

                </div>
            </aside>
        </nav>
    </div>
</template>

<script>
    import Dropdown from "@/Components/Extras/Dropdown.vue";
    import DropdownLink from "@/Components/Extras/DropdownLink.vue";
    export default {
        name: "MobileNav",
        components: {DropdownLink, Dropdown},
        props: ['studentInfo'],
        data() {
            return{
                isOpen: false
            }
        },
        methods: {
            drawer() {
                this.isOpen = !this.isOpen;
            },
            visit(val){
                this.isOpen = false
                this.$router.push(val);
            },
            logout(){
                this.$emit('signOut');
            }
        },
        // watch: {
        //     isOpen: {
        //         immediate: true,
        //         handler(isOpen) {
        //             if (process.client) {
        //                 if (isOpen) document.body.style.setProperty("overflow", "hidden");
        //                 else document.body.style.removeProperty("overflow");
        //             }
        //         }
        //     },

        // }
    }
</script>

<style scoped>

</style>
