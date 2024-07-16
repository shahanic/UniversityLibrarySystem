<template>
    <admin-layout>
        <template v-slot:main>
            <div class="container mx-auto p-4">
                <h1 class="text-2xl font-bold mb-4">Article Pages</h1>
                
                <input
                  type="text"
                  placeholder="Search..."
                  class="border rounded p-2 mb-4 w-full"
                />

                <table class="min-w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-gray-300 p-2">Question</th>
                            <th class="border border-gray-300 p-2">Answer</th>
                            <th class="border border-gray-300 p-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border border-gray-300 p-2">skibidi</td>
                            <td class="border border-gray-300 p-2">Toilet</td>
                            <td class="border border-gray-300 p-2">
                                <button class="bg-blue-500 text-white px-2 py-1 rounded">Edit</button>
                                <button class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                            </td>
                        </tr>
                        <!-- <tr>
                            <td class="border border-gray-300 p-2">Page Two</td>
                            <td class="border border-gray-300 p-2">Type B</td>
                            <td class="border border-gray-300 p-2">Menu B</td>
                            <td class="border border-gray-300 p-2">Description for page two</td>
                            <td class="border border-gray-300 p-2">
                                <button class="bg-blue-500 text-white px-2 py-1 rounded">Edit</button>
                                <button class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                            </td>
                        </tr> -->
                        <!-- Add more rows as needed -->
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
