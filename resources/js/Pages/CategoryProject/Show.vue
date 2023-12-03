<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
</script>

<template>
    <AppLayout title="Danh Mục Dự Án">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Danh Mục Dự Án
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg pt-8 pb-12 px-2">

                    <div class="float-right">
                        <Link :href="route('CategoryProjectCreate')" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded">
                        <icon :icon="['fas', 'plus']" /> Thêm dữ liệu
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import { Link } from '@inertiajs/vue3';


export default {

    components: {
        Link
    },

    // Các phương thức khác của component
}
</script>
