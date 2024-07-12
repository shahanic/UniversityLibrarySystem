<script setup>
import { Head, Link } from '@inertiajs/vue3';
import moment from 'moment';
import { GlobeAltIcon, BuildingLibraryIcon, UserGroupIcon, ArrowTrendingUpIcon, ServerStackIcon, TicketIcon ,FilmIcon, BookOpenIcon, CubeIcon, ComputerDesktopIcon } from '@heroicons/vue/24/outline'

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Head title="Home" />

    <main-layout>
        <template v-slot:main>
            <div class="h-screen w-full relative contrast-75 saturate-200">
                <div class="h-screen w-full bg-cover bg-center pt-16 md:-mt-32" style="background-image: url('/imgs/Library.jpg');">
                    <div class="flex justify-end min-h-full">
                        <div class="flex justify-center md:w-3/6 w-full">
                            <div class="bg-white/70  max-w-96 self-center rounded-xl backdrop-blur-md p-10 mx-3 contrast-150 shadow-2xl">
                                <p class="text-right text-xl font-semibold text-gray-700">Guided by the "information access" and "multimedia" concepts, the ULS intends to deliver quality service to you in your use of information needed in transforming and improving your life.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full bg-white">
                <div class="container mx-auto">
                    <div class="py-16">
                        <h3 class="text-center text-3xl text-gray-700 font-semibold">Services</h3>
                        <div class="flex flex-wrap md:justify-around">
                            <div class="flex gap-3 m-5">
                                <GlobeAltIcon class="w-10 h-10 text-green-700 bg-gradient-to-br self-center"></GlobeAltIcon>
                                <p class="self-center font-semibold">Web-based Online Public<br> Access Catalog (OPAC)</p>
                            </div>
                            <div class="flex gap-3 m-5">
                                <ServerStackIcon class="w-10 h-10 text-green-700 bg-gradient-to-br self-center"></ServerStackIcon>
                                <p class="self-center font-semibold">Database Searching</p>
                            </div>
                            <div class="flex gap-3 m-5">
                                <BuildingLibraryIcon class="w-10 h-10 text-green-700 bg-gradient-to-br self-center"></BuildingLibraryIcon>
                                <p class="self-center font-semibold">Library User Orientation<br> and Education</p>
                            </div>
                            <div class="flex gap-3 m-5">
                                <UserGroupIcon class="w-10 h-10 text-green-700 bg-gradient-to-br self-center"></UserGroupIcon>
                                <p class="self-center font-semibold">Reader’s Advisory and Referral</p>
                            </div>
                            <div class="flex gap-3 m-5">
                                <ArrowTrendingUpIcon class="w-10 h-10 text-green-700 bg-gradient-to-br self-center"></ArrowTrendingUpIcon>
                                <p class="self-center font-semibold">Current Awareness</p>
                            </div>
                            <div class="flex gap-3 m-5">
                                <TicketIcon class="w-10 h-10 text-green-700 bg-gradient-to-br "></TicketIcon>
                                <p class="self-center font-semibold">Displays/Exhibits</p>
                            </div>
                            <div class="flex gap-3 m-5">
                                <BookOpenIcon class="w-10 h-10 text-green-700 bg-gradient-to-br self-center"></BookOpenIcon>
                                <p class="self-center font-semibold">Lecture Series</p>
                            </div>
                            <div class="flex gap-3 m-5">
                                <CubeIcon class="w-10 h-10 text-green-700 bg-gradient-to-br self-center"></CubeIcon>
                                <p class="self-center font-semibold">Extension/Outreach Services</p>
                            </div>
                            <div class="flex gap-3 m-5">
                                <FilmIcon class="w-10 h-10 text-green-700 bg-gradient-to-br self-center"></FilmIcon>
                                <p class="self-center font-semibold">Audiovisual, Electronic Media, Internet,<br> Wi-Fi, and Other Special Services</p>
                                <!-- <p class="self-center font-semibold">Audiovisual, Electronic Media, Internet,<br> Wi-Fi, and Other Special Services <br>(e.g. Video Conferencing, Webcasts, etc.)</p> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full relative bg-cover" >
                <div class="flex flex-wrap">
                    <div class="md:py-10 px-5 md:w-1/2 bg-yellow-50 min-h-96 flex">
                        <div class=" flex flex-wrap justify-center md:justify-end">
                            <div class="md:w-1/2">
                                <h1 class="text-center font-bold text-yellow-900">Book for the Week</h1>
                                <h3 class="text-center font-semibold text-yellow-900"> {{ moment().format("MMMM Y") }}</h3>
                            </div>

                            <div class="py-10 flex  justify-end">
                                <div class="md:w-1/2">
                                    <div class="flex justify-center">
                                        <img class="w-52 shadow-lg" src="https://images-na.ssl-images-amazon.com/images/P/1260570533.01.MZZZZZZZ.jpg"/>
                                        <!-- <img src="https://images-na.ssl-images-amazon.com/images/P/113848069X.01.MZZZZZZZ.jpg"/>
                                        <img src="https://images-na.ssl-images-amazon.com/images/P/1265045844.01.MZZZZZZZ.jpg"/>
                                        <img src="https://images-na.ssl-images-amazon.com/images/P/1138587974.01.MZZZZZZZ.jpg"/>
                                        <img src="https://images-na.ssl-images-amazon.com/images/P/1337098132.01.MZZZZZZZ.jpg"/> -->
                                    </div>
                                    <h5 class="text-center font-semibold text-yellow-900">International management : culture, strategy, and behavior / Fred Luthans, Jonathan P. Doh</h5>
                                </div>
                                <!-- <div class="flex">
                                    <div class="slef-center">
                                        <p>Author/s: <br><b>Fred Luthans, Jonathan P. Doh</b></p>
                                        <p>Call Number: <br><b>HD 62.4 L88 2021 CBEA RC</b></p>
                                    </div>
                                </div> -->
                            </div>

                        </div>
                    </div>

                    <div class="bg-cover md:w-1/2 w-full min-h-96 contrast-75 saturate-150  bg-center" style="background-image: url('/imgs/botw.jpg');">

                        <div class="flex justify-center md:justify-start h-full w-full">

                            <div class="bg-green-900/80 max-w-96 self-start md:self-center rounded-xl backdrop-blur-md p-10 -mt-8 md:mt-0 contrast-150 md:mx-10">

                                <h4 class="text-white">Author/s: <br><b>Fred Luthans, Jonathan P. Doh</b></h4>
                                <h4 class="text-white">Call Number: <br><b>HD 62.4 L88 2021 CBEA RC</b></h4>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <!-- <div class="w-full bg-white"> -->
                <div class="container mx-auto">
                    <div class="py-20">
                    <div class="text-4xl !font-black text-center">
                        <span class="bg-clip-text text-transparent bg-gradient-to-r from-green-800 to-blue-700">
                            Events
                        </span>
                    </div>

                        <div class="flex gap-5 overflow-x-auto py-20 justify-around">
                            <div class="rounded-xl">
                                <div class="flex">
                                    <div class="bg-red-700 p-8 max-w-32 rounded-l-xl text-center flex">
                                        <h3 class=" text-white font-black self-center">
                                            {{ moment().format('MMM') }}<br>
                                            {{ moment().format('DD') }}
                                        </h3>
                                    </div>
                                    <div class="p-8 bg-white rounded-r-xl max-w-52">
                                        <h5 class="tone-1">8am-12nn</h5>
                                        <p class="tone-2">Sample Event Title</p>
                                        <p class="tone-2">Main Library</p>
                                    </div>
                                </div>
                            </div>

                            <div class="rounded-xl shadow-lg">
                                <div class="flex">
                                    <div class="bg-red-700 p-8 max-w-32 rounded-l-xl text-center flex">
                                        <h3 class=" text-white font-black self-center">
                                            {{ moment('2024-05-22').format('MMM') }}<br>
                                            {{ moment('2024-05-22').format('DD') }}
                                        </h3>
                                    </div>
                                    <div class="p-8 bg-white rounded-r-xl max-w-52">
                                        <h5 class="tone-1">8am-12nn</h5>
                                        <p class="tone-2">Sample Event Title</p>
                                        <p class="tone-2">Main Library</p>
                                    </div>
                                </div>
                            </div>

                            <div class="rounded-xl shadow-xl">
                                <div class="flex">
                                    <div class="bg-red-700 p-8 max-w-32 rounded-l-xl text-center flex">
                                        <h3 class=" text-white font-black self-center">
                                            {{ moment('2024-05-26').format('MMM') }}<br>
                                            {{ moment('2024-05-26').format('DD') }}
                                        </h3>
                                    </div>
                                    <div class="p-8 bg-white rounded-r-xl max-w-52">
                                        <h5 class="tone-1">8am-12nn</h5>
                                        <p class="tone-2">Sample Event Title</p>
                                        <p class="tone-2">Main Library</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- </div> -->

            <div class="bg-cover h-1/4 py-10 contrast-125 saturate-75 bg-center" style="background-image: url('/imgs/AC_Batac2.jpg');">

                <div class="container mx-auto">
                    <div class="flex justify-end relative">
                        <div class="w-full md:w-2/3">
                            <div class="bg-white/75  self-center rounded-xl backdrop-blur-lg p-12 contrast-150 mt-16 shadow-2xl">

                                <div class="flex justify-center -mt-28">
                                    <img class="h-36 w-36 rounded-full saturate-75 contrast-75 border-2 border-red-700" src="/imgs/AC_Batac.jpg"/>
                                </div>

                                <!-- <h2 class="text-center font-semibold text-gray-500">MMSU-American Corner Batac</h2> -->
                                <div class="text-4xl !font-black text-center">
                                    <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-700 to-red-700">
                                        MMSU-American Corner Batac
                                    </span>
                                </div>

                                <p class="text-xl font-semibold my-3 text-justify text-gray-500">
                                    The American Corner  (known as American Studies Resource Center) at the Mariano Marcos State University (MMSU) was initially established in 1984.
                                    It was formally inaugurated on January 14, 1985 with Mr. Herwald H. Morton, Director, United States Information Service (USIS) and Counselor of the
                                    Embassy for Public Affairs, as guest of honor. The  MMSU-American Corner (AC) is the center for Northern Luzon with 14 other centers located in strategic regions in the country.
                                </p>
                                <p class="text-xl font-semibold my-3 text-justify text-gray-500">
                                    The MMSU-AC is housed at the first floor, northwestern wing of the MMSU Main Library.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full bg-white py-20">
                <div class="container mx-auto">
                    <div class="text-4xl !font-black text-center">
                        <span class="bg-clip-text text-transparent bg-gradient-to-r from-green-800 to-blue-700">
                            Featured Links
                        </span>
                    </div>
                    <div class="flex flex-wrap justify-around py-16 gap-10">
                        <a href="https://ph.usembassy.gov/" target="_blank">
                            <img class="h-20 w-auto" src="/imgs/usem.png"/>
                        </a>
                        <a href="https://www.fulbright.org.ph/" target="_blank">
                            <img class="h-20 w-auto" src="https://www.fulbright.org.ph/images/drupal/Fulbright-Philippines-big-logo.png"/>
                        </a>
                        <a href="https://americanspacesph.org/" target="_blank">
                            <img class="h-20 w-auto" src="https://americanspacesph.files.wordpress.com/2019/01/cropped-untitled-design-9-1.png?w=426"/>
                        </a>
                        <a href="https://educationusa.state.gov/" target="_blank">
                            <img class="h-20 w-auto" src="https://educationusa.state.gov/sites/all/themes/custom/edusa/logo-color.png"/>
                        </a>
                        <a href="https://www.state.gov/bureaus-offices/under-secretary-for-public-diplomacy-and-public-affairs/bureau-of-global-public-affairs/" target="_blank">
                            <img class="h-20 w-auto" src="https://www.state.gov/wp-content/themes/state/images/logos/Logo_Navy_XL.png"/>
                        </a>
                    </div>
                </div>
            </div>

        </template>
    </main-layout>
</template>

<style>

</style>
