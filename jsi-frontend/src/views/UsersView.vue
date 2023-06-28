<template>
    <div>
        <div class="min-h-full">
            <side-bar-vue></side-bar-vue>
            <div class="flex flex-1 flex-col lg:pl-64">
                <div class="flex h-16 flex-shrink-0 border-b border-gray-200 bg-white lg:border-none">
                    <button type="button"
                        class="border-r border-gray-200 px-4 text-gray-400 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-cyan-500 lg:hidden">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12H12m-8.25 5.25h16.5" />
                        </svg>
                    </button>

                    <!-- topbar -->
                    <top-bar-vue></top-bar-vue>
                </div>
                <!-- content -->
                <main class="flex-1 pb-8">
                    <div class="px-4 sm:px-6 lg:px-8">
                        <div class="sm:flex sm:items-center">
                            <div class="sm:flex-auto">
                                <h1 class="text-xl font-semibold text-gray-900">Users</h1>
                            </div>
                            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                                <button type="button" @click="showModalNewUser"
                                    class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">Add
                                    user</button>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <input type="text" v-model="searchQuery" placeholder="Cari..."
                                class="border border-gray-300 px-4 py-2 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500 w-1/2">
                            <button @click="getUsersData"
                                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-r-lg ml-2">
                                Cari
                            </button>
                        </div>
                        <div class="mt-8 flex flex-col">
                            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                    <table class="min-w-full divide-y divide-gray-300">
                                        <thead>
                                            <tr>
                                                <th scope="col"
                                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 md:pl-0">
                                                    Name</th>
                                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6 md:pr-0">
                                                    <span class="sr-only">Edit</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200">
                                            <tr v-for="item in users" :key="item.id">
                                                <td
                                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 md:pl-0">
                                                    {{ item.name }}
                                                </td>
                                                <td
                                                    class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6 md:pr-0">
                                                    <button class="text-indigo-600 hover:text-indigo-900"
                                                        @click="showModal(item)">Edit<span class="sr-only">,
                                                        </span></button>
                                                </td>
                                                <td
                                                    class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6 md:pr-0">
                                                    <button v-on:click="removeUsers(item.id)"
                                                        class="text-red-600 hover:text-red-900">Remove<span
                                                            class="sr-only">, </span></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>

        <div v-if="selectedItem">
            <div class="fixed inset-0 flex items-center justify-center z-50">
                <div class="bg-white w-1/2 rounded-lg p-6">
                    <h3 class="text-xl mb-4">{{ selectedItem.name }}</h3>
                    <form @submit="updateItem">
                        <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                            <label for="employe_name"
                                class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">Name</label>
                            <div class="mt-1 sm:col-span-2 sm:mt-0">
                                <input type="text" v-model="selectedItem.name" id="name" autocomplete="given-name"
                                    class="w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <button class="bg-gray-600 text-white py-2 px-4 rounded-lg" type="submit">Simpan</button>
                            <button class="bg-red-600 text-white py-2 px-4 rounded-lg" @click="closeModal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="fixed inset-0 bg-black opacity-50 z-40" @click="closeModal"></div>
        </div>

        <div v-if="newUser">
            <div class="fixed inset-0 flex items-center justify-center z-50">
                <div class="bg-white w-1/2 rounded-lg p-6">
                    <h3 class="text-xl mb-4">New user</h3>
                    <form @submit="newUserStore">
                        <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                            <label for="employe_name"
                                class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">Name</label>
                            <div class="mt-1 sm:col-span-2 sm:mt-0">
                                <input type="text" v-model="name" id="name" autocomplete="given-name"
                                    class="w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <button class="bg-gray-600 text-white py-2 px-4 rounded-lg" type="submit">Simpan</button>
                            <button class="bg-red-600 text-white py-2 px-4 rounded-lg"
                                @click="closeModalNewUser">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="fixed inset-0 bg-black opacity-50 z-40" @click="closeModalNewUser"></div>
        </div>
    </div>
</template>

<script>
import SideBarVue from "@/components/SideBar.vue";
import TopBarVue from "@/components/TopBar.vue";
import axios from "axios";
export default {
    name: "UsersView",
    components: {
        SideBarVue, TopBarVue
    },
    data() {
        return {
            name: '',
            searchQuery: '',
            users: null,
            selectedItem: null,
            newUser: false,
        }
    },
    methods: {
        getUsersData: async function () {
            axios.request({
                url: 'http://localhost:80/api/users',
                method: 'GET',
                params: {
                    name: this.searchQuery
                }
            })
                .then((response) => {
                    this.users = response.data.results
                }).catch((error) => {
                    error
                })
        },
        removeUsers: async function (id) {
            axios.request({
                url: `http://localhost:80/api/user/${id}`,
                method: 'DELETE'
            }).then(response => {
                    console.log('Data berhasil dihapus:' + response);
                    this.getUsersData()
                })
                .catch(error => {
                    console.error('Terjadi kesalahan saat menghapus data:', error);
                });
        },
        showModal(item) {
            this.selectedItem = item;
        },
        closeModal() {
            this.selectedItem = null;
        },
        showModalNewUser() {
            this.newUser = true;
        },
        closeModalNewUser() {
            this.newUser = false;
            this.name = ''
        },
        updateItem(event) {
            event.preventDefault();
            axios.put(`http://localhost:80/api/user/${this.selectedItem.id}`, this.selectedItem)
                .then(response => {
                    console.log('Data berhasil diperbarui:', response.data);
                    this.selectedItem = null;
                })
                .catch(error => {
                    console.error('Terjadi kesalahan saat memperbarui data:', error);
                });
        },
        newUserStore(event) {
            event.preventDefault();
            axios.request({
                method: 'POST',
                url: 'http://localhost:80/api/user',
                data: {
                    name: this.name
                }
            }).then(response => {
                    console.log('Data berhasil diperbarui:', response.data);
                    this.closeModalNewUser()
                    this.getUsersData()
                })
                .catch(error => {
                    console.error('Terjadi kesalahan saat memperbarui data:', error);
                });
        }
    },
    mounted() {
        this.getUsersData()
    }
}
</script>