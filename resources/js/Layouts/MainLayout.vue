<script setup>

</script>

<template lang="">
    <div>
        <div class="hidden md:block">
            <div class="relative w-full h-24 z-10">
                <div class="flex justify-center w-full mt-6 py-2 border-y-2 border-green-950/60 bg-white">
                    <div class="-mt-8">
                        <img class="w-16 h-16 rounded-full self-center mx-auto" src="/imgs/ULS.jpg"/>
                        <h1 style="" class="text-2xl font-serif font-black text-gray-600 p-0 m-0">U<span class="text-xl">NIVERSITY</span> L<span class="text-xl">IBRARY</span> S<span class="text-xl">YSTEM</span></h1>
                        <p class="text-center text-sm font-serif text-gray-600 -mt-1">MARIANO MARCOS STATE UNIVERSITY</p>
                    </div>
                </div>
            </div>
            <div class=" relative flex justify-center bg-white shadow mt-1 z-10">
                <Link class="py-2 px-4 cursor-pointer font-bold text-gray-600 hover:bg-gray-200 " href="#">ABOUT</Link>
                <Link class="py-2 px-4 cursor-pointer font-bold text-gray-600 hover:bg-gray-200 " href="#">SERVICES</Link>
                <Link class="py-2 px-4 cursor-pointer font-bold text-gray-600 hover:bg-gray-200 " href="#">COLLECTIONS</Link>
                <Link class="py-2 px-4 cursor-pointer font-bold text-gray-600 hover:bg-gray-200 " href="#">NEWS & EVENTS</Link>
                <Link class="py-2 px-4 cursor-pointer font-bold text-gray-600 hover:bg-gray-200 " href="#">NEWSLETTER</Link>
                <Link class="py-2 px-4 cursor-pointer font-bold text-gray-600 hover:bg-gray-200 " href="#">GALLERY</Link>
                <Link class="py-2 px-4 cursor-pointer font-bold text-gray-600 hover:bg-gray-200 " href="#">FAQ</Link>
            </div>
        </div>

        <main>
            <slot name="main"/>
        </main>

        <footer class="bg-gray-600">
            <div class="w-full p-10 bg-green-700/75">
                <div class="container mx-auto">
                    <div class="flex flex-wrap gap-20">
                        <div class="flex gap-4">
                            <img class="w-32 h-32 rounded-full self-center" src="/imgs/mmsu.png"/>
                            <p class="self-center text-white text-7xl" style="font-family: 'Adobe Garamond Pro';">MMSU</p>
                        </div>
                        <div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full p-4 bg-green-700/50">
                <div class="container mx-auto">
                    <div class="flex justify-between">
                        <p class="text-xs text-white">
                            Developed by Information Technology Center (ITC)<br>
                            In Cooperation with the University Library System (ULS)<br>
                            Mariano Marcos State University 2012
                        </p>

                        <a class="self-center text-white" href="//mmsu.edu.ph" target="_target"> MMSU Home</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</template>
<style lang="">


</style>
