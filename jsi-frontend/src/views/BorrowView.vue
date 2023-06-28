<template>
<div>
    <div class="min-h-full">
        <side-bar-vue></side-bar-vue>
        <div class="flex flex-1 flex-col lg:pl-64">
            <div class="flex h-16 flex-shrink-0 border-b border-gray-200 bg-white lg:border-none">
                <button type="button" class="border-r border-gray-200 px-4 text-gray-400 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-cyan-500 lg:hidden">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12H12m-8.25 5.25h16.5" />
                    </svg>
                </button>

                <!-- topbar -->
                <top-bar-vue></top-bar-vue>
            </div>

            <main class="flex-1 pb-8">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-xl font-semibold text-gray-900">Borrows</h1>
                        </div>
                        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                            <button type="button" @click="showModalNew" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">Add
                            </button>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <input type="text" v-model="searchQuery" placeholder="Cari..." class="border border-gray-300 px-4 py-2 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500 w-1/2">
                        <div class="mt-1 sm:col-span-2 sm:mt-0">
                            <select v-model="filter" id="" class="w-full appearance-none border border-gray-300 px-4 py-2.5 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                <option v-for="item in lookUpFilter" :key="item" :value="item" :selected="filter === item">{{ item }}</option>
                            </select>
                        </div>
                        <button @click="queryBorrow" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-r-lg ml-2">
                            Cari
                        </button>
                    </div>
                    <div class="mt-8 flex flex-col">
                        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                <table class="min-w-full divide-y divide-gray-300">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 md:pl-0">
                                                Name</th>
                                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 md:pl-0">
                                                Book name</th>
                                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 md:pl-0">
                                                Borrow date</th>
                                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6 md:pr-0">
                                                <span class="sr-only">Edit</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        <tr v-for="item in borrows" :key="item.id">
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 md:pl-0">
                                                {{ item.name }}
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 md:pl-0">
                                                {{ item.book_name }}
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 md:pl-0">
                                                {{ item.borrow_date }}
                                            </td>
                                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6 md:pr-0">
                                                <button class="text-indigo-600 hover:text-indigo-900" @click="showModal(item)">Edit<span class="sr-only">,
                                                    </span></button>
                                            </td>
                                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6 md:pr-0">
                                                <button v-on:click="removeBorrow(item.borrow_id)" class="text-red-600 hover:text-red-900">Remove<span class="sr-only">, </span></button>
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
                    <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:pt-5">
                        <label for="name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">Users</label>
                        <div class="mt-1 sm:col-span-2 sm:mt-0">
                            <select v-model="selectedUser" id="" class="w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                <option v-for="user in usersDropdown" :key="user.id" :value="user.id" :selected="selectedUser === user.id">{{ user.name }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:pt-5">
                        <label for="name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">Books</label>
                        <div class="mt-1 sm:col-span-2 sm:mt-0">
                            <select v-model="selectedBook" id="" class="w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                <option v-for="book in bookDropdown" :key="book.id" :value="book.id" :selected="selectedBook === book.id">{{ book.name }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:pt-5">
                        <label for="name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">Date</label>
                        <div class="mt-1 sm:col-span-2 sm:mt-0">
                            <input type="text" v-model="selectedItem.borrow_date" id="name" autocomplete="given-name" class="w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
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
    <div v-if="newBorrow">
        <div class="fixed inset-0 flex items-center justify-center z-50">
            <div class="bg-white w-1/2 rounded-lg p-6">
                <h3 class="text-xl mb-4">New</h3>
                <form @submit="storeNewBorrow">
                    <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:pt-5">
                        <label for="name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">Users</label>
                        <div class="mt-1 sm:col-span-2 sm:mt-0">
                            <select v-model="selectedUser" id="" class="w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                <option v-for="user in usersDropdown" :key="user.id" :value="user.id" :selected="selectedUser === user.id">{{ user.name }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:pt-5">
                        <label for="name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">Books</label>
                        <div class="mt-1 sm:col-span-2 sm:mt-0">
                            <select v-model="selectedBook" id="" class="w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                <option v-for="book in bookDropdown" :key="book.id" :value="book.id" :selected="selectedBook === book.id">{{ book.name }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:pt-5">
                        <label for="name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">Date</label>
                        <div class="mt-1 sm:col-span-2 sm:mt-0">
                            <input type="date" v-model="borrow_date" id="name" autocomplete="given-name" class="w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button class="bg-gray-600 text-white py-2 px-4 rounded-lg" type="submit">Simpan</button>
                        <button class="bg-red-600 text-white py-2 px-4 rounded-lg" @click="closeModalNew">Batal</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="fixed inset-0 bg-black opacity-50 z-40" @click="closeModal"></div>
    </div>
</div>
</template>

<script>
import SideBarVue from "@/components/SideBar.vue";
import TopBarVue from "@/components/TopBar.vue";
import axios from "axios";
export default {
    name: "BorrowView",
    components: {
        SideBarVue,
        TopBarVue
    },
    data() {
        return {
            filter: 'user_name',
            searchQuery: '',
            lookUpFilter: ['book_name', 'user_name'],
            borrow_date: '',
            name: '',
            borrows: null,
            selectedItem: null,
            selectedUser: null,
            usersDropdown: [],
            selectedBook: null,
            bookDropdown: [],
            newBorrow: false,
        }
    },
    methods: {
        queryBorrow() {
            if ((this.filter != "") && (this.searchQuery != "")) {
                this.getBorrowList()
            } else {
                this.getBorrowList()
                this.searchQuery = ''
                alert("Failed to query")
            }
        },
        getBorrowList: async function () {
            axios.request({
                url: 'http://localhost:80/api/borrows',
                method: 'GET',
                params: {
                    [this.filter]: this.searchQuery
                },
            }).then((response) => {
                this.borrows = response.data.results
            }).catch((err) => {
                console.log(err);
            })
        },
        getLookUpUsers: async function () {
            axios.request({
                url: 'http://localhost:80/api/users',
                method: 'GET',
            }).then((response) => {
                const users = response.data.results
                users.forEach(item => {
                    this.usersDropdown.push({
                        id: item.id,
                        name: item.name,
                    })
                });
            }).catch((err) => {
                console.log(err);
            })
        },
        getLookUpBooks: async function () {
            axios.request({
                url: 'http://localhost:80/api/books',
                method: 'GET',
            }).then((response) => {
                const books = response.data.results
                books.forEach(item => {
                    this.bookDropdown.push({
                        id: item.id,
                        name: item.name,
                    })
                });
            }).catch((err) => {
                console.log(err);
            })
        },
        updateItem(event) {
            event.preventDefault();
            axios.request({
                    url: `http://localhost:80/api/borrow/${this.selectedItem.borrow_id}`,
                    method: 'PUT',
                    data: {
                        user_id: this.selectedUser,
                        book_id: this.selectedBook,
                        borrow_date: this.selectedItem.borrow_date
                    },
                }).then(response => {
                    console.log('Data berhasil diperbarui:', response.data);
                    this.selectedItem = null;
                    this.getBorrowList()
                })
                .catch(error => {
                    console.error('Terjadi kesalahan saat memperbarui data:', error);
                });
        },
        removeBorrow: async function (id) {
            axios.request({
                    url: `http://localhost:80/api/borrow/${id}`,
                    method: 'DELETE'
                }).then(response => {
                    console.log('Data berhasil dihapus:' + response);
                    this.getBorrowList()
                })
                .catch(error => {
                    console.error('Terjadi kesalahan saat menghapus data:', error);
                });
        },
        showModal(item) {
            this.selectedItem = item;
            this.selectedUser = item.user_id;
            this.selectedBook = item.book_id;
            this.getLookUpUsers()
            this.getLookUpBooks()
        },
        closeModal() {
            this.selectedItem = null;
            this.selectedUser = null;
            this.usersDropdown = []
            this.bookDropdown = []
        },
        showModalNew() {
            this.newBorrow = true;
            this.getLookUpUsers()
            this.getLookUpBooks()
        },
        closeModalNew() {
            this.newBorrow = false;
            this.usersDropdown = []
            this.bookDropdown = []
        },
        storeNewBorrow(event) {
            event.preventDefault()
            axios.request({
                    url: 'http://localhost:80/api/borrow',
                    method: 'POST',
                    data: {
                        user_id: this.selectedUser,
                        book_id: this.selectedBook,
                        borrow_date: this.borrow_date
                    }
                }).then(response => {
                    console.log('Data berhasil diperbarui:', response.data);
                    this.selectedUser = null;
                    this.selectedBook = null;
                    this.borrow_date = '';
                    this.newBorrow = false;
                    this.getBorrowList()
                    this.usersDropdown = []
                    this.bookDropdown = []
                })
                .catch(error => {
                    console.error('Terjadi kesalahan saat memperbarui data:', error);
                });
        }
    },
    mounted() {
        this.getBorrowList()
    }
}
</script>
