<template>
    <aside id="sidebar" class="w-full p-1  dark:bg-gray-900 dark:text-gray-100 h-screen">
        <div class="sidebar-header">
            <div class="logo">
                <img src="/images/vnwaLogoFull.png" class="show" alt="Vinawebapp Logo">
                <img src="/images/vnwaLogoIcon.png" class="hide" alt="Vinawebapp Logo">
            </div>
            <div class="btn">

                <span className='relative inline-block overflow-hidden rounded-full p-[1px]'>
                    <span className='absolute inset-[-1000%] animate-[spin_2s_linear_infinite] bg-[conic-gradient(from_90deg_at_50%_50%,#E2CBFF_0%,#393BB2_50%,#E2CBFF_100%)]' />
                    <div className='inline-flex h-full w-full cursor-pointer items-center justify-center rounded-full bg-slate-950/90 px-3 py-1 text-sm font-medium text-white backdrop-blur-3xl'>
                        <icon icon="fa-xmark" class="show" />
                        <icon icon="fa-bars" class="hide" />
                    </div>
                </span>
            </div>
        </div>
        <div class="sidebar-content">
            <ul>
                <li class="mb-3">
                    <SideBarLink :href="route('dashboard')" :active="route().current('dashboard')">
                        <icon icon="fa-home" class="mr-2" />
                        <span>Trang chủ</span>
                    </SideBarLink>
                </li>
                <li class="mb-3">
                    <SideBarLink :href="route('dashboard')" :active="route().current('setting')">
                        <icon icon="fa-home" class="mr-2" />
                        <span>Trang chủ</span>
                    </SideBarLink>
                </li>

            </ul>
        </div>
    </aside>
</template>
<script>
import SideBarLink from '@/Components/SideBarLink.vue';

export default {
    name: 'SideBar',
    components: {
        SideBarLink,
    },

};
</script>
