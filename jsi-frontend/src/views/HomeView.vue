<template>
  <div>
    <div class="min-h-full">
      <side-bar-vue></side-bar-vue>

      <div class="flex flex-1 flex-col lg:pl-64">
        <div class="
            flex
            h-16
            flex-shrink-0
            border-b border-gray-200
            bg-white
            lg:border-none
          ">
          <button type="button" class="
              border-r border-gray-200
              px-4
              text-gray-400
              focus:outline-none
              focus:ring-2
              focus:ring-inset
              focus:ring-cyan-500
              lg:hidden">
            <span class="sr-only">Open sidebar</span>
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12H12m-8.25 5.25h16.5" />
            </svg>
          </button>

          <!-- topbar -->
          <top-bar-vue></top-bar-vue>

        </div>
        <!-- content -->
        <main class="flex-1 pb-8">

          <div class="mt-8">
            <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
              <h2 class="text-lg font-medium leading-6 text-gray-900">
                Overview
              </h2>
              <div class="
                  mt-2
                  grid grid-cols-1
                  gap-5
                  sm:grid-cols-2
                  lg:grid-cols-3
                ">
                <!-- Card -->

                <div class="overflow-hidden rounded-lg bg-white shadow">
                  <div class="p-5">
                    <div class="flex items-center">
                      <div class="flex-shrink-0">
                        <!-- Heroicon name: outline/scale -->
                        <svg class="h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                          viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                          <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0012 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.317 3 .52m-3-.52l2.62 10.726c.122.499-.106 1.028-.589 1.202a5.988 5.988 0 01-2.031.352 5.988 5.988 0 01-2.031-.352c-.483-.174-.711-.703-.59-1.202L18.75 4.971zm-16.5.52c.99-.203 1.99-.377 3-.52m0 0l2.62 10.726c.122.499-.106 1.028-.589 1.202a5.989 5.989 0 01-2.031.352 5.989 5.989 0 01-2.031-.352c-.483-.174-.711-.703-.59-1.202L5.25 4.971z" />
                        </svg>
                      </div>
                      <div class="ml-5 w-0 flex-1">
                        <dl>
                          <dt class="truncate text-sm font-medium text-gray-500">
                            Jumlah Peminjam Bulan Ini
                          </dt>
                          <dd>
                            <div class="text-lg font-medium text-gray-900">
                              {{ this.this_month }}
                            </div>
                          </dd>
                        </dl>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="overflow-hidden rounded-lg bg-white shadow">
                  <div class="p-5">
                    <div class="flex items-center">
                      <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                          viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                          <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0012 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.317 3 .52m-3-.52l2.62 10.726c.122.499-.106 1.028-.589 1.202a5.988 5.988 0 01-2.031.352 5.988 5.988 0 01-2.031-.352c-.483-.174-.711-.703-.59-1.202L18.75 4.971zm-16.5.52c.99-.203 1.99-.377 3-.52m0 0l2.62 10.726c.122.499-.106 1.028-.589 1.202a5.989 5.989 0 01-2.031.352 5.989 5.989 0 01-2.031-.352c-.483-.174-.711-.703-.59-1.202L5.25 4.971z" />
                        </svg>
                      </div>
                      <div class="ml-5 w-0 flex-1">
                        <dl>
                          <dt class="truncate text-sm font-medium text-gray-500">
                            Jumlah Peminjam 6 Bulan Terakhir
                          </dt>
                          <dd>
                            <div class="text-lg font-medium text-gray-900">
                              {{ this.six_months }}
                            </div>
                          </dd>
                        </dl>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- More items... -->
              </div>
            </div>

            <h2 class="
                mx-auto
                mt-8
                max-w-6xl
                px-4
                text-lg
                font-medium
                leading-6
                text-gray-900
                sm:px-6
                lg:px-8
              ">
              Recent activity
            </h2>

            <!-- Activity list (smallest breakpoint only) -->
            <div class="shadow sm:hidden">
              <ul role="list" class="
                  mt-2
                  divide-y divide-gray-200
                  overflow-hidden
                  shadow
                  sm:hidden
                ">
                <li v-for="item in this.users"
          :key="item.name">
                  <a href="#" class="block bg-white px-4 py-4 hover:bg-gray-50">
                    <span class="flex items-center space-x-4">
                      <span class="flex flex-1 space-x-2 truncate">
                        <span class="flex flex-col truncate text-sm text-gray-500">
                          <span class="truncate">{{ item.name }}</span>
                          <span class="font-medium text-gray-900">{{ item.borrow_count }}</span>
                        </span>
                      </span>
                      <svg class="h-5 w-5 flex-shrink-0 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd"
                          d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                          clip-rule="evenodd" />
                      </svg>
                    </span>
                  </a>
                </li>
              </ul>
            </div>

            <!-- Activity table (small breakpoint and up) -->
            <div class="hidden sm:block">
              <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
                <div class="mt-2 flex flex-col">
                  <div class="
                      min-w-full
                      overflow-hidden overflow-x-auto
                      align-middle
                      shadow
                      sm:rounded-lg
                    ">
                    <table class="min-w-full divide-y divide-gray-200">
                      <thead>
                        <tr>
                          <th class="
                              bg-gray-50
                              px-6
                              py-3
                              text-left text-sm
                              font-semibold
                              text-gray-900
                            " scope="col">
                            Name
                          </th>
                          <th class="
                              bg-gray-50
                              px-6
                              py-3
                              text-right text-sm
                              font-semibold
                              text-gray-900
                            " scope="col">
                            Jumlah
                          </th>
                        </tr>
                      </thead>
                      <tbody class="divide-y divide-gray-200 bg-white">
                        <tr class="bg-white" v-for="item in this.users"
          :key="item.name">
                          <td class="
                              w-full
                              max-w-0
                              whitespace-nowrap
                              px-6
                              py-4
                              text-sm text-gray-900
                            ">
                            <div class="flex">
                              <a href="#" class="
                                  group
                                  inline-flex
                                  space-x-2
                                  truncate
                                  text-sm
                                ">
                                <p class="
                                    truncate
                                    text-gray-500
                                    group-hover:text-gray-900
                                  ">
                                  {{ item.name }}
                                </p>
                              </a>
                            </div>
                          </td>
                          <td class="
                              whitespace-nowrap
                              px-6
                              py-4
                              text-right text-sm text-gray-500
                            ">
                            <span class="font-medium text-gray-900">{{ item.borrow_count }}</span>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </main>
        <!-- end -->
      </div>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import SideBarVue from "@/components/SideBar.vue";
import TopBarVue from "@/components/TopBar.vue";
import axios from "axios";
export default {
  name: "HomeView",
  data() {
    return {
      this_month: null,
      six_months: null,
      users: null,
    }
  },
  methods: {
    getDataDashboard: async function () {
      const data = await axios.request({
        method: 'GET',
        url: 'http://localhost:80/api/dashboard'
      }).then((response) => {
        return response.data
      }).catch((error) => {
        return error.response
      })


      this.this_month = data.results.this_month
      this.six_months = data.results.six_month
      this.users = data.results.user
    }
  },
  mounted() {
    this.getDataDashboard()
  },
  components: {
    SideBarVue, TopBarVue
  },
};
</script>
