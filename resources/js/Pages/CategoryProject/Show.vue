<template>
    <AppLayout title="Danh Mục Dự Án">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Danh Mục Dự Án
            </h2>
        </template>

        <div class="py-2">
            <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg pt-8 pb-12 px-2">

                    <div class="float-right text-xs uppercase">
                        <Link :href="route('CategoryProjectCreate')" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-2 rounded">
                        <icon :icon="['fas', 'plus']" /> Thêm dữ liệu
                        </Link>
                    </div>

                    <div class="my-2 py-10">
                        <DataTable :headers="headers" :items="dataPage" buttons-pagination show-index v-model:items-selected="itemsSelected">
                            <template #item-name="{ name, url_avatar }">
                                <div class="py-3 flex items-center justify-start">
                                    <img :src="url_avatar" alt="vinawebapp.com" class="w-20 h-auto mr-3 block"> <span class=" block text-sm font-bold">{{ name }}</span>
                                </div>
                            </template>
                            <template #item-status="{ id, status }">
                                <div class="flex items-center cursor-pointer">
                                    <input type="checkbox" :id="'checkbox-' + id" v-model="checkedItems[id]" class="hidden" @change="handleStatusChange(id, status)" />
                                    <label :for="'checkbox-' + id" class="flex items-center cursor-pointer">
                                        <div class="relative">
                                            <div class="toggle-path bg-gray-300 w-9 h-5 rounded-full p-0">
                                                <div class="toggle-circle bg-white w-5 h-5 rounded-full shadow-md" :class="{ 'transform translate-x-full bg-purple-500': checkedItems[id] }"></div>
                                            </div>
                                        </div>

                                    </label>
                                </div>

                            </template>

                            <template #item-operation="{ id }">
                                <div class="py-3 flex items-center justify-center">
                                    <button class="bg-red-600 text-white px-2 py-1 rounded-md mr-5">
                                        <icon :icon="['fas', 'trash']" />
                                    </button>
                                    <Link :href="route('CategoryProjectEdit', id)" class="bg-yellow-600 text-white px-2 py-1 rounded-md mr-5">
                                    <icon :icon="['fas', 'pen-to-square']" />
                                    </Link>
                                </div>
                            </template>
                            <template #expand="item">
                                <div class="py-4  px-3 bg-neutral-950 text-white">
                                    <div class="grid grid-cols-12 mb-3 w-full">
                                        <div class="col-span-3 p-2 border flex items-center font-bold">
                                            Tên dữ liệu
                                        </div>
                                        <div class="col-span-9 p-2 border">
                                            <span class="text-lg">{{ item.name }}</span>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-12 mb-3 w-full">
                                        <div class="col-span-3 p-2 border flex items-center font-bold">
                                            Ảnh dữ liệu
                                        </div>
                                        <div class="col-span-9 p-2 border">
                                            <div class="flex">
                                                <div>
                                                    <img :src="item.url_avatar" alt="vinawebapp.com" class="w-20 h-auto mr-3 block">
                                                    Avatar Desktop
                                                </div>
                                                <div class="ml-10">
                                                    <img :src="item.url_avatar_mobile" alt="vinawebapp.com" class="w-20 h-auto mr-3 block">
                                                    Avatar Mobile
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-12 mb-3 w-full">
                                        <div class="col-span-3 p-2 border flex items-center font-bold">
                                            Ảnh kèm theo
                                        </div>
                                        <div class="col-span-9 p-2 border">
                                            <div class="flex">
                                                <div>
                                                    <img :src="item.url_avatar" alt="vinawebapp.com" class="w-20 h-auto mr-3 block">
                                                    Avatar Desktop
                                                </div>
                                                <div class="ml-10">
                                                    <img :src="item.url_avatar_mobile" alt="vinawebapp.com" class="w-20 h-auto mr-3 block">
                                                    Avatar Mobile
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </DataTable>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import { Link, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';


export default {
    props: {
    },

    components: {
        Link, AppLayout,
        Welcome
    },
    data() {
        return {

            itemsSelected: [],
            headers: [
                { text: "Tên dữ liệu", value: "name" },
                { text: "View", value: "view" },
                { text: "Ngày tạo", value: "create_time" },
                { text: "Trạng thái", value: "status" },
                { text: "Hành động", value: "operation" },
            ],

        };
    },
    methods: {
        async handleStatusChange(id, currentStatus) {
            console.log(this.checkedItems);
            try {
                const newStatus = !currentStatus ? 1 : 0;
                // Gửi POST request tới server để thay đổi giá trị status
                const response = await axios.post('/change-status', {
                    tb: 'category_projects',
                    id: id,
                    status: newStatus, // Chuyển đổi giá trị status
                });




            } catch (error) {
                console.error('Error while changing status:', error);
            }
        },
    },
    setup() {
        const dataPage = ref([]);
        const data = usePage();
        dataPage.value = data.props.data;
        dataPage.value = data.props.data.map(item => {
            return { ...item, status: item.status === 1 ? true : false };
        });
        const checkedItems = ref([]);
        dataPage.value.forEach(element => {
            checkedItems.value[element.id] = element.status;
        });
        return {
            dataPage, checkedItems
        }
    },
    // Các phương thức khác của component
}
</script>
