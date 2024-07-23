<template>
    <admin-layout>
        <template v-slot:main>
            <div class="container mx-auto p-4">
                <h1 class="text-2xl font-bold mb-4 text-center">Generic Pages</h1>
                
                <!-- <input
                  type="text"
                  placeholder="Search..."
                  class="border rounded p-2 mb-4 w-full"
                /> -->

                <table class="min-w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-400">
                            <th class="border border-gray-300 text-white p-2">ID</th>
                            <th class="border border-gray-300 text-white p-2">Name</th>
                            <th class="border border-gray-300 text-white p-2">Main Navigation</th>
                            <th class="border border-gray-300 text-white p-2">Subnavigation</th>
                            <th class="border border-gray-300 text-white p-2">Order</th>
                            <th class="border border-gray-300 text-white p-2">Status</th>
                            <th class="border border-gray-300 text-white p-2">Created By</th>
                            <th class="border border-gray-300 text-white p-2">Modified By</th>
                            <th class="border border-gray-300 p-2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border border-gray-300 p-2"></td>
                            <td class="border border-gray-300 p-2"></td>
                            <td class="border border-gray-300 p-2"></td>
                            <td class="border border-gray-300 p-2"></td>
                            <td class="border border-gray-300 p-2"></td>
                            <td class="border border-gray-300 p-2"></td>
                            <td class="border border-gray-300 p-2"></td>
                            <td class="border border-gray-300 p-2"></td>
                            <td class="border border-gray-300 p-2 " style="width: 18%;">
                                <button class="bg-green-900 text-white px-2 py-1 rounded mr-3">PREVIEW</button>
                                <button class="bg-yellow-500 text-gray px-2 py-1 rounded mr-3">EDIT</button>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>


        </template>
    </admin-layout>
</template>

<style scoped>
.container {
    max-width: 1500px;
}
</style>