<template>
    <aside id="sidebar" :class="{ active: sideBarActive }" class="w-full p-1  dark:bg-gray-900 dark:text-gray-100 h-auto">
        <div class="sidebar-header">

            <div class="logo">
                <img src="/images/vnwaLogoFull.png" class="show" alt="Vinawebapp Logo">
                <img src="/images/vnwaLogoIcon.png" class="hide" alt="Vinawebapp Logo">
            </div>
            <!-- <div class="btn" @click="toggleSidebar">
                <span className='relative inline-block overflow-hidden rounded-full p-[1px]'>
                    <span className='absolute inset-[-1000%] animate-[spin_2s_linear_infinite] bg-[conic-gradient(from_90deg_at_50%_50%,#E2CBFF_0%,#393BB2_50%,#E2CBFF_100%)]' />
                    <div className='inline-flex h-full w-full cursor-pointer items-center justify-center rounded-full bg-slate-950/90 px-3 py-1 text-sm font-medium text-white backdrop-blur-3xl'>
                        <icon icon="fa-xmark" class="show" />
                        <icon icon="fa-bars" class="hide" />
                    </div>
                </span>
            </div> -->
        </div>
        <div class="sidebar-content">
            <ul id="sidebar-content-list">
                <li class="mb-3">
                    <SideBarLink :href="route('dashboard')" :active="check('/dashboard')">
                        <icon icon="fa-home" class="mr-2" />
                        <span class="show  font-semibold text-slate-900 dark:text-slate-200">Trang chủ</span>
                    </SideBarLink>
                </li>

                <li class="mb-3">
                    <div class=" cursor-pointer relative w-100 py-2 px-4 rounded sidebar-item-list " :class="{ active: isProject || check('/category-project') || check('/project') }">
                        <div class="flex items-center justify-left sidebar-item-list-title" @click="ProjectToggle">
                            <icon :icon="['fab', 'r-project']" class="mr-2" />
                            <span class="show  font-semibold text-slate-900 dark:text-slate-200">Dự án</span>
                            <icon :icon="['fas', 'chevron-down']" class="ml-2 show" />
                        </div>

                        <div class="sidebar-item-list-content  mt-3">
                            <ul class=" border-l border-purple-100">
                                <li class="mb-1">
                                    <SideBarMenuItemLink :href="route('CategoryProject')" :active="check('/category-project')">
                                        Danh mục dự án
                                    </SideBarMenuItemLink>
                                </li>
                                <li class="mb-1">
                                    <SideBarMenuItemLink :href="route('dashboard')" :active="check('/project')">
                                        Dự án
                                    </SideBarMenuItemLink>

                                </li>
                            </ul>
                        </div>
                    </div>

                </li>
            </ul>
        </div>
    </aside>
</template>
<script>
import SideBarLink from '@/Components/SideBarLink.vue';
import SideBarMenuItemLink from '@/Components/SideBarMenuItemLink.vue';
import { Link } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

export default {
    created() {

    },
    data() {
        return {
            isProject: false,
        }
    },

    name: 'SideBar',
    components: {
        SideBarLink, SideBarMenuItemLink, Link
    },

    computed: {

        sideBarActive() {
            // return this.$store.state.sideBarActive;
            return false
        },
    },
    methods: {
        check(path) {
            const { url } = usePage();
            console.log(url);

            if (url.includes(path)) {
                return true;
            } else {
                return false;

            }
            // return isActive;
        },
        toggleSidebar() {
            this.$store.commit('toggleSidebar');
        },
        ProjectToggle() {
            this.isProject = !this.isProject;
        },
    },
    setup() {

    },

};
</script>
