<template>
    <admin-layout>
        <template v-slot:main>
            <div class="container mx-auto p-4">
                <h1 class="text-2xl text-white font-bold mb-4">Generic Pages</h1>
                
                <input
                  type="text"
                  placeholder="Search..."
                  class="border rounded p-2 mb-4 w-full"
                />

                <table class="min-w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-gray-300 p-2">Titles</th>
                            <th class="border border-gray-300 p-2">Types</th>
                            <th class="border border-gray-300 p-2">Parent Menu</th>
                            <th class="border border-gray-300 p-2">Descriptions</th>
                            <th class="border border-gray-300 p-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border border-gray-300 p-2">Page One</td>
                            <td class="border border-gray-300 p-2">Type A</td>
                            <td class="border border-gray-300 p-2">Menu A</td>
                            <td class="border border-gray-300 p-2">Description for page one</td>
                            <td class="border border-gray-300 p-2 text-center">
                                <button class="bg-blue-500 text-white px-2 py-1 rounded mr-3">Edit</button>
                                <button class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
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
